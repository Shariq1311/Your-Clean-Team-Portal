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

    // Update sitename in app_configs
    $sitename = 'Mojar';
    $stmt = $pdo->prepare("SELECT * FROM app_configs WHERE code = ? LIMIT 1");
    $stmt->execute(['sitename']);
    if ($stmt->fetch()) {
        $pdo->prepare("UPDATE app_configs SET value = ? WHERE code = ?")->execute([$sitename, 'sitename']);
        echo "Updated app_configs.sitename to '$sitename'\n";
    } else {
        $pdo->prepare("INSERT INTO app_configs (code, value) VALUES (?, ?)")->execute(['sitename', $sitename]);
        echo "Inserted app_configs.sitename = '$sitename'\n";
    }

    // Additional branding keys to replace legacy values
    $branding = [
        'title' => 'Mojar',
        'logo' => 'mc-styles/Mojar/assets/static/logo.png',
        'different_auth_logo' => 'mc-styles/Mojar/assets/static/logo.png',
        'admin_logo' => 'mc-styles/Mojar/assets/static/logo.png',
        'pwa_app_name' => 'Mojar',
        'pwa_description' => 'Mojar portal',
    ];
    foreach ($branding as $code => $value) {
        $s = $pdo->prepare("SELECT id FROM app_configs WHERE code = ? LIMIT 1");
        $s->execute([$code]);
        if ($s->fetch()) {
            $pdo->prepare("UPDATE app_configs SET value = ? WHERE code = ?")->execute([$value, $code]);
            echo "Updated app_configs.$code to '$value'\n";
        } else {
            $pdo->prepare("INSERT INTO app_configs (code, value) VALUES (?, ?)")->execute([$code, $value]);
            echo "Inserted app_configs.$code = '$value'\n";
        }
    }

    // Update passwords for test users
    $password = password_hash('password123', PASSWORD_BCRYPT);
    $emails = ['admin@cleanteam.local','john@cleanteam.local','jane@cleanteam.local'];
    foreach ($emails as $e) {
        $u = $pdo->prepare('SELECT id FROM app_users WHERE email = ? LIMIT 1');
        $u->execute([$e]);
        $row = $u->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $pdo->prepare('UPDATE app_users SET password = ?, is_admin = ?, email_verified_at = ? WHERE id = ?')
                ->execute([$password, $e === 'admin@cleanteam.local' ? 1 : 0, date('Y-m-d H:i:s'), $row['id']]);
            echo "Set password for $e\n";
        } else {
            echo "User $e not found, skipping\n";
        }
    }

} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage() . "\n";
}

// Update .env files to set APP_NAME
function updateEnvFile($path, $key, $value) {
    if (!file_exists($path)) return false;
    $lines = file($path, FILE_IGNORE_NEW_LINES);
    $found = false;
    foreach ($lines as &$line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            [$k,$v] = explode('=', $line, 2);
            if (trim($k) === $key) {
                $line = $k . '=' . $value;
                $found = true;
            }
        }
    }
    if (!$found) $lines[] = $key . '=' . $value;
    file_put_contents($path, implode("\n", $lines) . "\n");
    return true;
}

$root = realpath(__DIR__ . '/..');
updateEnvFile($root . '/.env', 'APP_NAME', 'Mojar');
updateEnvFile($root . '/.env.example', 'APP_NAME', 'Mojar');
updateEnvFile($root . '/.env.testing.example', 'APP_NAME', 'Mojar');
echo "Updated .env APP_NAME entries where present.\n";
