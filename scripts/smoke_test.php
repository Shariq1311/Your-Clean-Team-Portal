<?php
$urls = ['http://127.0.0.1:8000/','http://127.0.0.1:8000/app','http://127.0.0.1:8000/app/login','http://127.0.0.1:8000/login'];
foreach ($urls as $u) {
    $c = @file_get_contents($u);
    if ($c === false) {
        echo "$u - ERROR\n";
        continue;
    }
    if (strpos($c, 'Welcome to Your Clean Team') !== false) {
        echo "$u - FOUND\n";
    } else {
        echo "$u - NOTFOUND\n";
    }
}
