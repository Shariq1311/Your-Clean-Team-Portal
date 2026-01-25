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

    $branding = [
        'title' => 'Mojar',
        'logo' => 'mc-styles/Mojar/assets/static/logo.png',
        'different_auth_logo' => 'mc-styles/Mojar/assets/static/logo.png',
        'admin_logo' => 'mc-styles/Mojar/assets/static/logo.png'
    ];

    foreach ($branding as $code => $value) {
        $stmt = $pdo->prepare('SELECT id FROM app_configs WHERE code = ? LIMIT 1');
        $stmt->execute([$code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $pdo->prepare('UPDATE app_configs SET value = ? WHERE code = ?')->execute([$value, $code]);
            echo "Updated $code => $value\n";
        } else {
            $pdo->prepare('INSERT INTO app_configs (code, value) VALUES (?, ?)')->execute([$code, $value]);
            echo "Inserted $code => $value\n";
        }
    }

    echo "Branding updated.\n";
} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage() . "\n";
}
