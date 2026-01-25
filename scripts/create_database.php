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

if (empty($dbName)) {
    echo "No DB name configured in .env (DB_DATABASE).\n";
    exit(1);
}

try {
    $dsn = "mysql:host=$dbHost;port=$dbPort;charset=utf8";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "Database `$dbName` ensured (created if missing).\n";
} catch (Exception $e) {
    echo "Failed to create database: " . $e->getMessage() . "\n";
    exit(1);
}
