<?php
// Quick setup script to create test users
require 'bootstrap/app.php';

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__)
);

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Create admin user
$admin = \MojarCMS\CMS\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@cleanteam.local',
    'password' => bcrypt('password123'),
    'is_admin' => 1,
    'status' => 'active',
]);

echo "✓ Admin created: admin@cleanteam.local (password: password123)\n";

// Create employee user
$employee = \MojarCMS\CMS\Models\User::create([
    'name' => 'John Smith',
    'email' => 'john@cleanteam.local',
    'password' => bcrypt('password123'),
    'is_admin' => 0,
    'status' => 'active',
    'position' => 'Cleaning Technician',
    'hourly_rate' => 25.00,
]);

echo "✓ Employee created: john@cleanteam.local (password: password123)\n";

// Create another employee for testing
$employee2 = \MojarCMS\CMS\Models\User::create([
    'name' => 'Jane Doe',
    'email' => 'jane@cleanteam.local',
    'password' => bcrypt('password123'),
    'is_admin' => 0,
    'status' => 'active',
    'position' => 'Team Lead',
    'hourly_rate' => 28.00,
]);

echo "✓ Employee created: jane@cleanteam.local (password: password123)\n";

echo "\n✓ Setup complete!\n";
