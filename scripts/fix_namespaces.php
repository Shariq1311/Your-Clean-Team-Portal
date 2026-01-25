<?php
// Fix accidental namespace replacements caused by branding sweep.
// Usage: php scripts/fix_namespaces.php

$root = realpath(__DIR__ . '/../');
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
$count = 0;
$files = [];
foreach ($iterator as $file) {
    if (!$file->isFile()) continue;
    $path = $file->getPathname();
    if (strpos($path, DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR) !== false) continue;
    if (strpos($path, DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR) !== false) continue;
    if (!preg_match('/\.php$/i', $path)) continue;
    $content = file_get_contents($path);
    if (strpos($content, 'MojarCMS') !== false) {
        $new = str_replace('MojarCMS', 'MojarCMS', $content);
        file_put_contents($path, $new);
        $count++;
        $files[] = $path;
    }
    // fix 'Mojar\\CMS' patterns
    if (strpos($content, 'Mojar\\CMS') !== false) {
        $new = str_replace('Mojar\\CMS', 'MojarCMS\\CMS', $content);
        file_put_contents($path, $new);
        if (!in_array($path, $files)) { $count++; $files[] = $path; }
    }
    // Replace raw 'Mojar' in PHP identifiers (skip config and view files)
    if (strpos($content, 'Mojar') !== false
        && strpos($path, DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR) === false
        && strpos($path, DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR) === false
    ) {
        $new = str_replace('Mojar', 'Mojar', $content);
        file_put_contents($path, $new);
        if (!in_array($path, $files)) { $count++; $files[] = $path; }
    }
}

echo "Fixed namespaces in {$count} files:\n";
foreach ($files as $f) echo " - {$f}\n";

exit(0);
