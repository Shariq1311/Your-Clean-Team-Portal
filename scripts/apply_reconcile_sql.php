<?php
// apply_reconcile_sql.php
// Executes non-comment SQL statements in files under scripts/reconcile_sql/
// Usage: php scripts/apply_reconcile_sql.php

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

$dir = __DIR__ . '/reconcile_sql';
if (!is_dir($dir)) {
    echo "No reconcile_sql directory found. Nothing to apply." . PHP_EOL;
    exit(0);
}

$files = glob($dir . '/*.sql');
if (empty($files)) {
    echo "No SQL files to apply." . PHP_EOL;
    exit(0);
}

$summary = [];
foreach ($files as $file) {
    echo "Applying: " . basename($file) . "\n";
    $content = file($file, FILE_IGNORE_NEW_LINES);
    $sqlRaw = '';
    foreach ($content as $line) {
        $trim = trim($line);
        if ($trim === '' || strpos($trim, '--') === 0) continue;
        $sqlRaw .= $line . "\n";
    }
    $stmts = array_filter(array_map('trim', explode(';', $sqlRaw)));
    $fileSummary = ['file' => basename($file), 'statements' => 0, 'affected' => 0, 'errors' => []];
    foreach ($stmts as $stmt) {
        try {
            $res = $pdo->exec($stmt);
            $fileSummary['statements']++;
            $fileSummary['affected'] += ($res === false ? 0 : $res);
        } catch (Exception $e) {
            $fileSummary['errors'][] = $e->getMessage();
            echo "  ERROR executing statement: " . $e->getMessage() . "\n";
        }
    }
    $summary[] = $fileSummary;
    echo "  Done: statements={$fileSummary['statements']} affected={$fileSummary['affected']} errors=" . count($fileSummary['errors']) . "\n\n";
}

echo "Apply complete. Summary:\n";
foreach ($summary as $s) {
    echo " - {$s['file']}: stmts={$s['statements']} affected={$s['affected']} errors=" . count($s['errors']) . "\n";
}

exit(0);
