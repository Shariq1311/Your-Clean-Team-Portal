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
    $dsn = "mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "Schema for app_configs:\n";
    $desc = $pdo->query("DESCRIBE `app_configs`")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($desc as $col) {
        echo $col['Field']." ".$col['Type']."\n";
    }
    echo "\nRequested config values:\n";
    $codes = ['title','sitename','logo','different_auth_logo','auth_layout'];
    $placeholders = implode(',', array_fill(0, count($codes), '?'));
    $stmt = $pdo->prepare("SELECT `code`, `value` FROM `app_configs` WHERE `code` IN ($placeholders)");
    $stmt->execute($codes);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $r) {
        echo $r['code']." => ".trim($r['value'])."\n";
    }
        echo "\nAlso check unprefixed configs table:\n";
        try {
            $stmt = $pdo->prepare("SELECT `code`, `value` FROM `configs` WHERE `code` IN ($placeholders)");
            $stmt->execute($codes);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $r) {
                echo $r['code']." => ".trim($r['value'])."\n";
            }
        } catch (Exception $e) {
            echo "configs table not present or query failed.\n";
        }
            echo "\nDescribe configs table if present:\n";
            try {
                $desc2 = $pdo->query("DESCRIBE `configs`")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($desc2 as $col) {
                    echo $col['Field']." ".$col['Type']."\n";
                }
            } catch (Exception $e) {
                echo "No configs table.\n";
            }

            echo "\nFirst 50 rows from configs table:\n";
            try {
                $rows = $pdo->query("SELECT `code`, `value` FROM `configs` LIMIT 50")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows as $r) echo $r['code']." => ".trim($r['value'])."\n";
            } catch (Exception $e) {
                echo "Unable to read configs table.\n";
            }
} catch (Exception $e) {
    echo "DB error: " . $e->getMessage() . "\n";
    exit(1);
}
