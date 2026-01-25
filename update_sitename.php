<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

DB::table('configs')->where('name', 'sitename')->update(['value' => 'Mojar']);
echo "✅ Site name updated to 'Mojar'!\n";
