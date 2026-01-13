<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'user:create-admin {name=Admin} {email=admin@example.com} {password=password}';

    protected $description = 'Create an admin user';

    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        $existingUser = User::where('email', $email)->first();
        
        if ($existingUser) {
            $this->error("Потребителят с имейл '{$email}' вече съществува!");
            return 1;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);

        $this->info("✅ Администраторът '{$name}' е успешно създаден!");
        $this->info("📧 Имейл: {$email}");
        $this->info("🔑 Парола: {$password}");

        return 0;
    }
}
