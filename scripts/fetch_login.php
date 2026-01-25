<?php
$c = @file_get_contents('http://127.0.0.1:8000/login');
file_put_contents(__DIR__.'/login.html', $c === false ? 'ERROR' : $c);
echo "done\n";
