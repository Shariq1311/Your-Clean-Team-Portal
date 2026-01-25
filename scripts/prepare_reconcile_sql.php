<?php
// prepare_reconcile_sql.php
// Scans the DB for duplicate table pairs (app_<name> and <name>) and
// generates per-pair SQL files with non-destructive backup + merge/rename suggestions.

function env($key, $default = null) {
    static $vars = null;
    if ($vars === null) {
        $vars = [];
        $envFile = __DIR__ . '/../.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) continue;
                if (!strpos($line, '=')) continue;
                list($k, $v) = explode('=', $line, 2);
                $k = trim($k); $v = trim($v);
                $v = trim($v, "\"'");
                $vars[$k] = $v;
            }
        }
    }
    return array_key_exists($key, $vars) ? $vars[$key] : $default;
}

$dbHost = env('DB_HOST', '127.0.0.1');
$dbPort = env('DB_PORT', '3306');
$dbName = env('DB_DATABASE', 'your_clean_team');
$dbUser = env('DB_USERNAME', 'root');
$dbPass = env('DB_PASSWORD', '');

try {
    $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    echo "ERROR: Could not connect to DB: " . $e->getMessage() . PHP_EOL;
    exit(1);
}

// gather tables
$tables = [];
$stmt = $pdo->query("SHOW TABLES");
while ($row = $stmt->fetch(PDO::FETCH_NUM)) $tables[] = $row[0];

$pairs = [];
foreach ($tables as $t) {
    if (strpos($t, 'app_') === 0) {
        $base = substr($t, 4);
        if (in_array($base, $tables)) {
            $pairs[$t] = $base; // app_table => table
        }
    }
}

if (empty($pairs)) {
    echo "No duplicate app_/unprefixed table pairs found." . PHP_EOL;
    exit(0);
}

// ensure output dirs
$outDir = __DIR__ . '/reconcile_sql';
if (!is_dir($outDir)) mkdir($outDir, 0755, true);
$backupDir = __DIR__ . '/backups';
if (!is_dir($backupDir)) mkdir($backupDir, 0755, true);

echo "Found " . count($pairs) . " duplicate table pairs. Preparing SQL files...\n";

foreach ($pairs as $app => $plain) {
    echo " - Pair: {$app} <=> {$plain}\n";
    // gather create statements
    $c1 = $pdo->query("SHOW CREATE TABLE `{$app}`")->fetch(PDO::FETCH_ASSOC);
    $c2 = $pdo->query("SHOW CREATE TABLE `{$plain}`")->fetch(PDO::FETCH_ASSOC);
    $createApp = $c1['Create Table'] ?? reset($c1);
    $createPlain = $c2['Create Table'] ?? reset($c2);

    // backup both tables
    $ts = date('Ymd_His');
    $bfile = "{$backupDir}/{$app}_{$ts}.sql";
    $fh = fopen($bfile, 'w');
    fwrite($fh, "-- Backup of {$app}\nDROP TABLE IF EXISTS `{$app}`;\n");
    fwrite($fh, $createApp . ";\n\n");
    $rows = $pdo->query("SELECT * FROM `{$app}`")->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($rows)) {
        $cols = array_map(function($c){return "`$c`";}, array_keys($rows[0]));
        $colsSql = implode(', ', $cols);
        foreach ($rows as $r) {
            $vals = array_map(function($v) use ($pdo){ return $v === null ? 'NULL' : $pdo->quote($v); }, array_values($r));
            fwrite($fh, "INSERT INTO `{$app}` ({$colsSql}) VALUES (" . implode(', ', $vals) . ");\n");
        }
    }
    fclose($fh);

    $bfile2 = "{$backupDir}/{$plain}_{$ts}.sql";
    $fh2 = fopen($bfile2, 'w');
    fwrite($fh2, "-- Backup of {$plain}\nDROP TABLE IF EXISTS `{$plain}`;\n");
    fwrite($fh2, $createPlain . ";\n\n");
    $rows2 = $pdo->query("SELECT * FROM `{$plain}`")->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($rows2)) {
        $cols = array_map(function($c){return "`$c`";}, array_keys($rows2[0]));
        $colsSql = implode(', ', $cols);
        foreach ($rows2 as $r) {
            $vals = array_map(function($v) use ($pdo){ return $v === null ? 'NULL' : $pdo->quote($v); }, array_values($r));
            fwrite($fh2, "INSERT INTO `{$plain}` ({$colsSql}) VALUES (" . implode(', ', $vals) . ");\n");
        }
    }
    fclose($fh2);

    // compare columns and primary keys
    $colsApp = $pdo->query("SHOW COLUMNS FROM `{$app}`")->fetchAll(PDO::FETCH_ASSOC);
    $colsPlain = $pdo->query("SHOW COLUMNS FROM `{$plain}`")->fetchAll(PDO::FETCH_ASSOC);
    $namesApp = array_column($colsApp, 'Field');
    $namesPlain = array_column($colsPlain, 'Field');

    $common = array_intersect($namesApp, $namesPlain);

    // find primary key column if any (single-column PK)
    $pk = null;
    foreach ($colsApp as $c) { if ($c['Key'] === 'PRI') { $pk = $c['Field']; break; } }
    if (!$pk) foreach ($colsPlain as $c) { if ($c['Key'] === 'PRI') { $pk = $c['Field']; break; } }

    $outFile = "{$outDir}/{$app}_reconcile_{$ts}.sql";
    $of = fopen($outFile, 'w');
    fwrite($of, "-- Reconcile: {$app} <=> {$plain}\n");
    fwrite($of, "-- Backups saved: {$bfile}, {$bfile2}\n\n");

    fwrite($of, "-- Option A: Merge rows from {$app} into {$plain} (non-destructive).\n");
    if (!empty($common)) {
        $colsList = implode(', ', array_map(function($c){return "`$c`";}, $common));
        if ($pk) {
            fwrite($of, "-- Using primary key `{$pk}` to avoid duplicates.\n");
            $sql = "INSERT INTO `{$plain}` ({$colsList}) SELECT {$colsList} FROM `{$app}` AS s WHERE NOT EXISTS (SELECT 1 FROM `{$plain}` AS t WHERE t.`{$pk}` = s.`{$pk}`);";
            fwrite($of, $sql . "\n\n");
        } else {
            fwrite($of, "-- No single-column primary key detected. Consider reviewing unique keys before running the insert.\n");
            $sql = "INSERT IGNORE INTO `{$plain}` ({$colsList}) SELECT {$colsList} FROM `{$app}`;";
            fwrite($of, $sql . "\n\n");
        }
    } else {
        fwrite($of, "-- No common columns to safely merge. Manual inspection required.\n\n");
    }

    fwrite($of, "-- Option B: If you prefer to keep `{$app}` as canonical table name, you can rename: (non-destructive)");
    fwrite($of, "\n-- RENAME TABLE `{$plain}` TO `{$plain}_backup_{$ts}`, `{$app}` TO `{$plain}`;\n\n");

    fwrite($of, "-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)\n");
    fwrite($of, "-- DROP TABLE `{$app}`;\n\n");

    fwrite($of, "-- NOTES:\n-- 1) Verify schema compatibility and indexes before running Option A.\n-- 2) Run backups first: mysql < {$bfile}; mysql < {$bfile2} if needed to restore.\n");
    fclose($of);

    echo "   Generated: {$outFile} (backups: {$bfile}, {$bfile2})\n";
}

echo "\nDone. Review SQL files in scripts/reconcile_sql/, backups in scripts/backups/." . PHP_EOL;

exit(0);
