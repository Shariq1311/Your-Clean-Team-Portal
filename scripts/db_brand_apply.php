<?php
// db_brand_apply.php
// Usage: php scripts/db_brand_apply.php
// This script will:
//  - scan DB text columns for legacy branding
//  - create a per-table SQL backup (CREATE + INSERTs) in scripts/backups/
//  - run UPDATE statements to replace legacy terms with 'Mojar'

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

$legacy = [
    'Mojar', 'mojar',
    'TechGuru', 'techguru'
];

try {
    $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    echo "ERROR: Could not connect to DB: " . $e->getMessage() . PHP_EOL;
    exit(1);
}

function is_text_type($type) {
    $type = strtolower($type);
    return (strpos($type, 'char') !== false) || (strpos($type, 'text') !== false) || (strpos($type, 'json') !== false);
}

// find affected tables/cols
$tables = [];
$stmt = $pdo->query("SHOW TABLES");
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    $tables[] = $row[0];
}

$affected = [];
foreach ($tables as $table) {
    $cols = [];
    $cstmt = $pdo->query("SHOW COLUMNS FROM `{$table}`");
    while ($crow = $cstmt->fetch(PDO::FETCH_ASSOC)) {
        if (is_text_type($crow['Type'])) $cols[] = $crow['Field'];
    }
    if (empty($cols)) continue;

    foreach ($cols as $col) {
        $total = 0;
        foreach ($legacy as $term) {
            $q = $pdo->prepare("SELECT COUNT(*) as cnt FROM `{$table}` WHERE `{$col}` LIKE :pat");
            $q->execute([':pat' => "%{$term}%"]);
            $cnt = (int)$q->fetch(PDO::FETCH_ASSOC)['cnt'];
            $total += $cnt;
        }
        if ($total > 0) {
            $affected[$table][$col] = $total;
        }
    }
}

if (empty($affected)) {
    echo "No legacy branding found in DB; nothing to apply." . PHP_EOL;
    exit(0);
}

// ensure backups dir
$backupDir = __DIR__ . '/backups';
if (!is_dir($backupDir)) mkdir($backupDir, 0755, true);

foreach ($affected as $table => $cols) {
    echo "Backing up table {$table}..." . PHP_EOL;
    // get create statement
    $row = $pdo->query("SHOW CREATE TABLE `{$table}`")->fetch(PDO::FETCH_ASSOC);
    $create = $row['Create Table'] ?? $row['Create Table'];
    $timestamp = date('Ymd_His');
    $file = "{$backupDir}/{$table}_{$timestamp}.sql";
    $fh = fopen($file, 'w');
    fwrite($fh, "-- Backup of {$table} from {$dbName} at {$timestamp}\n");
    fwrite($fh, "DROP TABLE IF EXISTS `{$table}`;\n");
    fwrite($fh, $create . ";\n\n");

    // dump rows as INSERTs
    $rows = $pdo->query("SELECT * FROM `{$table}`")->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($rows)) {
        $colsList = array_map(function($c){ return "`$c`"; }, array_keys($rows[0]));
        $colsSql = implode(', ', $colsList);
        foreach ($rows as $r) {
            $vals = array_map(function($v) use ($pdo) {
                if ($v === null) return 'NULL';
                return $pdo->quote($v);
            }, array_values($r));
            fwrite($fh, "INSERT INTO `{$table}` ({$colsSql}) VALUES (" . implode(', ', $vals) . ");\n");
        }
    }
    fclose($fh);
    echo "Backup written to {$file}" . PHP_EOL;

    // apply replacements on each affected column
    foreach ($cols as $col => $cnt) {
        echo "Updating {$table}.{$col} (approx {$cnt} rows)..." . PHP_EOL;
        $updates = [];
        foreach ($legacy as $term) {
            // use simple REPLACE for each term
            $updates[] = "`{$col}` = REPLACE(`{$col}`, " . $pdo->quote($term) . ", " . $pdo->quote('Mojar') . ")";
        }
        $sql = "UPDATE `{$table}` SET " . implode(', ', $updates) . " WHERE ";
        $wheres = [];
        foreach ($legacy as $term) {
            $wheres[] = "`{$col}` LIKE " . $pdo->quote('%'.$term.'%');
        }
        $sql .= implode(' OR ', $wheres);
        $affectedRows = $pdo->exec($sql);
        echo " - Rows affected: " . ($affectedRows === false ? 'ERROR' : $affectedRows) . PHP_EOL;
    }
}

echo "\nDB branding replacements complete. Backups in scripts/backups/." . PHP_EOL;

exit(0);
