<?php
function parseEnv($path) {
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
$host = $env['DB_HOST'] ?? '127.0.0.1';
$port = $env['DB_PORT'] ?? '3306';
$db   = $env['DB_DATABASE'] ?? '';
$user = $env['DB_USERNAME'] ?? '';
$pass = $env['DB_PASSWORD'] ?? '';
$prefix = $env['DB_PREFIX'] ?? '';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    echo "Connected to database $db\n";

    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_NUM);
    echo "Tables:\n";
    foreach ($tables as $t) {
        echo " - " . $t[0] . "\n";
    }

    $candidates = [];
    foreach ($tables as $t) {
        $name = $t[0];
        if (stripos($name, 'config') !== false || stripos($name, 'setting') !== false) {
            $candidates[] = $name;
        }
    }

    if (empty($candidates)) {
        echo "No config-like tables found.\n";
    } else {
        echo "\nPossible config tables:\n";
        foreach ($candidates as $c) {
            echo "\n-- $c columns --\n";
            $cols = $pdo->query("SHOW COLUMNS FROM `$c`")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($cols as $col) {
                echo $col['Field'] . " (" . $col['Type'] . ")\n";
            }
            // show sample rows
            $rows = $pdo->query("SELECT * FROM `$c` LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
            echo "Sample rows:\n";
            print_r($rows);
        }
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
