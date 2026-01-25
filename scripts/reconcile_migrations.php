<?php
require __DIR__ . '/../vendor/autoload.php';

function parseEnv($path) {
    if (!file_exists($path)) return [];
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $vars = [];
    foreach ($lines as $line) {
        if (strpos(trim($line),'#')===0) continue;
        if (!strpos($line,'=')) continue;
        [$k,$v] = explode('=', $line, 2);
        $k = trim($k);
        $v = trim($v);
        $v = trim($v, "\"'");
        $vars[$k] = $v;
    }
    return $vars;
}

$env = parseEnv(__DIR__ . '/../.env');
$dbHost = $env['DB_HOST'] ?? '127.0.0.1';
$dbPort = $env['DB_PORT'] ?? '3306';
$dbName = $env['DB_DATABASE'] ?? '';
$dbUser = $env['DB_USERNAME'] ?? 'root';
$dbPass = $env['DB_PASSWORD'] ?? '';

if (empty($dbName)) {
    echo "No DB configured (DB_DATABASE).\n";
    exit(1);
}

$dsn = "mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8mb4";
$pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

function backupTable($pdo, $table) {
    $ts = date('Ymd_His');
    $bak = $table . '_bak_' . $ts;
    echo "Creating backup table $bak...\n";
    $pdo->exec("CREATE TABLE `$bak` AS SELECT * FROM `$table`");
    echo "Backup $bak created.\n";
}

// Ensure both tables exist?
$tables = $pdo->query("SELECT TABLE_NAME FROM information_schema.tables WHERE TABLE_SCHEMA = '".addslashes($dbName)."'")->fetchAll(PDO::FETCH_COLUMN);
$has_app_migrations = in_array('app_migrations', $tables);
$has_migrations = in_array('migrations', $tables);

echo "DB: $dbName\n";
echo "Found migrations tables: migrations=".($has_migrations? 'yes':'no')." app_migrations=".($has_app_migrations? 'yes':'no')."\n";

if ($has_app_migrations) {
    $count_app = (int)$pdo->query("SELECT COUNT(*) FROM `app_migrations`")->fetchColumn();
    echo "app_migrations rows: $count_app\n";
} else {
    $count_app = 0;
}
if ($has_migrations) {
    $count = (int)$pdo->query("SELECT COUNT(*) FROM `migrations`")->fetchColumn();
    echo "migrations rows: $count\n";
} else {
    $count = 0;
}

// If Laravel `migrations` empty but app_migrations has entries, copy them over
if ($has_app_migrations && $count === 0 && $count_app > 0) {
    echo "Preparing to copy app_migrations -> migrations\n";
    if (!$has_migrations) {
        echo "Creating migrations table by copying schema from app_migrations...\n";
        // Create migrations table with same schema
        $pdo->exec("CREATE TABLE `migrations` LIKE `app_migrations`");
        echo "Created migrations table.\n";
    } else {
        // backup original migrations
        backupTable($pdo, 'migrations');
    }
    backupTable($pdo, 'app_migrations');

    // Copy rows that don't exist yet
    $insertSql = "INSERT INTO `migrations` (migration, batch) SELECT migration, batch FROM `app_migrations` WHERE migration NOT IN (SELECT migration FROM `migrations`)";
    $rowsBefore = (int)$pdo->query("SELECT COUNT(*) FROM `migrations`")->fetchColumn();
    $affected = $pdo->exec($insertSql);
    $rowsAfter = (int)$pdo->query("SELECT COUNT(*) FROM `migrations`")->fetchColumn();
    echo "Inserted $affected rows into migrations (before: $rowsBefore, after: $rowsAfter).\n";
} else {
    echo "No action needed for migrations copy.\n";
}

// Next: report duplicate table pairs (app_<name> and <name>) so user can review
echo "\nScanning for duplicate prefixed/unprefixed table pairs...\n";
$dupPairs = [];
foreach ($tables as $t) {
    if (strpos($t, 'app_') === 0) {
        $base = substr($t, 4);
        if (in_array($base, $tables)) {
            $dupPairs[] = [$t, $base];
        }
    }
}
if (empty($dupPairs)) {
    echo "No duplicate pairs found.\n";
} else {
    echo "Found duplicate table pairs (prefixed, unprefixed):\n";
    foreach ($dupPairs as $p) echo " - {$p[0]}  <=>  {$p[1]}\n";
    echo "\nFor safety, I will not modify duplicated tables automatically. I can prepare SQL to merge or rename on request.\n";
}

echo "Done.\n";
