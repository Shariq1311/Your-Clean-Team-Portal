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

$root = realpath(__DIR__ . '/..');
$env = parseEnv($root . '/.env');
$dbHost = $env['DB_HOST'] ?? '127.0.0.1';
$dbPort = $env['DB_PORT'] ?? '3306';
$dbName = $env['DB_DATABASE'] ?? '';
$dbUser = $env['DB_USERNAME'] ?? 'root';
$dbPass = $env['DB_PASSWORD'] ?? '';

try {
    $dsn = "mysql:host=$dbHost;port=$dbPort;charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "Connected to MySQL server.\n";
    $stmt = $pdo->query("SELECT TABLE_NAME FROM information_schema.tables WHERE TABLE_SCHEMA = '".addslashes($dbName)."' ORDER BY TABLE_NAME");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (empty($tables)) {
        echo "No tables found in database `$dbName`.\n";
    } else {
        echo "Tables in `$dbName`:\n";
        foreach ($tables as $t) echo " - $t\n";
    }

    if (in_array('app_migrations', $tables)) {
        echo "\nSchema of `app_migrations`:\n";
        $desc = $pdo->query("DESCRIBE `".addslashes($dbName)."`.`app_migrations`")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($desc as $col) {
            echo sprintf("%s %s %s %s %s\n", $col['Field'], $col['Type'], $col['Null'], $col['Key'], $col['Extra']);
        }
    } else {
        echo "\n`app_migrations` table not found.\n";
    }

} catch (Exception $e) {
    echo "DB error: " . $e->getMessage() . "\n";
    exit(1);
}
