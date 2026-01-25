<?php
// DB branding scan script
// Usage: php scripts/db_brand_scan.php

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

$tables = [];
$stmt = $pdo->query("SHOW TABLES");
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    $tables[] = $row[0];
}

echo "Scanning {$dbName}: " . count($tables) . " tables..." . PHP_EOL;

$summary = [];
foreach ($tables as $table) {
    $cols = [];
    $cstmt = $pdo->query("SHOW COLUMNS FROM `{$table}`");
    while ($crow = $cstmt->fetch(PDO::FETCH_ASSOC)) {
        if (is_text_type($crow['Type'])) {
            $cols[] = $crow['Field'];
        }
    }
    if (empty($cols)) continue;

    foreach ($cols as $col) {
        $found = false;
        foreach ($legacy as $term) {
            $q = $pdo->prepare("SELECT COUNT(*) as cnt FROM `{$table}` WHERE `{$col}` LIKE :pat");
            $q->execute([':pat' => "%{$term}%"]);
            $cnt = (int)$q->fetch(PDO::FETCH_ASSOC)['cnt'];
            if ($cnt > 0) {
                if (!isset($summary[$table])) $summary[$table] = [];
                if (!isset($summary[$table][$col])) $summary[$table][$col] = 0;
                $summary[$table][$col] += $cnt;
                $found = true;
            }
        }
        if ($found) {
            // print sample rows
            $s = $pdo->prepare("SELECT `{$col}` FROM `{$table}` WHERE `{$col}` LIKE :pat LIMIT 5");
            $s->execute([':pat' => "%{$term}%"]);
            $samples = $s->fetchAll(PDO::FETCH_COLUMN);
            echo "\nTable: {$table}  Column: {$col}  Matches: " . count($samples) . " (showing up to 5)" . PHP_EOL;
            foreach ($samples as $sample) {
                $preview = mb_substr(trim(preg_replace('/\s+/', ' ', $sample)), 0, 240);
                echo " - " . $preview . PHP_EOL;
            }
        }
    }
}

if (empty($summary)) {
    echo "\nNo legacy branding strings found in DB text columns." . PHP_EOL;
} else {
    echo "\nSummary of findings:" . PHP_EOL;
    foreach ($summary as $t => $cols) {
        foreach ($cols as $c => $cnt) {
            echo " - {$t}.{$c}: {$cnt} matches" . PHP_EOL;
        }
    }
    echo "\nNext: I can prepare per-table UPDATE statements with backups. Confirm to proceed." . PHP_EOL;
}

exit(0);
