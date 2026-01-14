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
            $existingUser->is_admin = true;
            $existingUser->save();

            $this->info("✅ Потребителят '{$existingUser->name}' съществува — статусът е актуализиран като администратор.");
            return 0;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->is_admin = true;
        $user->save();

        $this->info("✅ Администраторът '{$name}' е успешно създаден!");
        $this->info("📧 Имейл: {$email}");
        $this->info("🔑 Парола: {$password}");

        return 0;
    }
}
