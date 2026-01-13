<?php

// Quick script to create admin user
// Run: php create-admin.php from the theater-app directory

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Create or update admin user
$admin = User::firstOrCreate(
    ['email' => 'tugaytanju3@gmail.com'],
    [
        'name' => 'Тугай Хасан',
        'password' => Hash::make('123456789'),
        'is_admin' => true,
        'email_verified_at' => now(),
    ]
);

// Make sure is_admin is set to true
if (!$admin->is_admin) {
    $admin->update(['is_admin' => true]);
}

echo "✅ Администраторът успешно създаден/обновен!\n";
echo "📧 Имейл: " . $admin->email . "\n";
echo "🔑 Парола: 123456789\n";
echo "👤 Име: " . $admin->name . "\n";
echo "🔐 Администратор: " . ($admin->is_admin ? "ДА" : "НЕ") . "\n";
