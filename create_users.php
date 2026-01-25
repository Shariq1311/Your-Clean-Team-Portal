<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use MojarCMS\CMS\Models\User;
use Illuminate\Support\Facades\Hash;

// Clear existing test users
User::whereIn('email', [
    'admin@cleanteam.local',
    'john@cleanteam.local',
    'jane@cleanteam.local'
])->delete();

// Create admin user
User::create([
    'name' => 'Admin User',
    'email' => 'admin@cleanteam.local',
    'password' => Hash::make('password123'),
    'is_admin' => 1,
    'email_verified_at' => now(),
]);

// Create employee 1
User::create([
    'name' => 'John Doe',
    'email' => 'john@cleanteam.local',
    'password' => Hash::make('password123'),
    'is_admin' => 0,
    'email_verified_at' => now(),
]);

// Create employee 2
User::create([
    'name' => 'Jane Smith',
    'email' => 'jane@cleanteam.local',
    'password' => Hash::make('password123'),
    'is_admin' => 0,
    'email_verified_at' => now(),
]);

echo "✅ Users created successfully!\n";
echo "Admin: admin@cleanteam.local / password123\n";
echo "Employee 1: john@cleanteam.local / password123\n";
echo "Employee 2: jane@cleanteam.local / password123\n";
