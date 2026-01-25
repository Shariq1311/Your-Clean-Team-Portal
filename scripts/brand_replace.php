<?php
require __DIR__ . '/../vendor/autoload.php';

function scanFiles($root, $patterns, $excludeDirs = ['vendor','node_modules','.git','storage']) {
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
    $matches = [];
    foreach ($it as $file) {
        if (!$file->isFile()) continue;
        $path = $file->getPathname();
        $skip = false;
        foreach ($excludeDirs as $d) if (strpos($path, DIRECTORY_SEPARATOR.$d.DIRECTORY_SEPARATOR)!==false) { $skip = true; break; }
        if ($skip) continue;
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if (!in_array($ext, ['php','blade.php','js','ts','jsx','tsx','css','scss','html','twig','json','md','env'])) continue;
        $content = file_get_contents($path);
        foreach ($patterns as $p) {
            if (stripos($content, $p) !== false) {
                $matches[$path][] = $p;
            }
        }
    }
    return $matches;
}

function replaceInFiles($matches, $replacements) {
    foreach ($matches as $path => $found) {
        $content = file_get_contents($path);
        $orig = $content;
        foreach ($replacements as $from => $to) {
            $content = str_ireplace($from, $to, $content);
        }
        if ($content !== $orig) {
            // backup file
            copy($path, $path . '.bak');
            file_put_contents($path, $content);
            echo "Updated: $path\n";
        }
    }
}

$root = realpath(__DIR__ . '/..');
$patterns = ['Mojar','Mojar','Mojar','Mojar'];
$replacements = [
    'Mojar' => 'Mojar',
    'Mojar' => 'yourcleanteam',
    'Mojar' => 'Mojar',
    'Mojar' => 'yourcleanteam'
];

echo "Scanning files for legacy branding...\n";
$matches = scanFiles($root, $patterns);
echo "Found " . count($matches) . " files with matches.\n";
foreach ($matches as $p => $arr) echo " - $p\n";

if (php_sapi_name() === 'cli') {
    echo "\nRun with `php scripts/brand_replace.php apply` to perform replacements.\n";
    if (isset($argv[1]) && $argv[1] === 'apply') {
        echo "Applying replacements...\n";
        replaceInFiles($matches, $replacements);
        echo "Done. Backups are saved with .bak suffix.\n";
    }
}
