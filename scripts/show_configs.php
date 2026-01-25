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

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $keys = ['sitename','title','logo','different_auth_logo','admin_logo','site_logo','app_name'];
    foreach ($keys as $k) {
        $stmt = $pdo->prepare('SELECT * FROM app_configs WHERE code = ? LIMIT 1');
        $stmt->execute([$k]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "\nKey: $k\n";
        if ($row) print_r($row); else echo "Not found\n";
    }
    // show first 20 configs
    echo "\nFirst 20 app_configs rows:\n";
    $rows = $pdo->query('SELECT * FROM app_configs LIMIT 20')->fetchAll(PDO::FETCH_ASSOC);
    print_r($rows);
} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage() . "\n";
}
