<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Създаваме АДМИН потребител, за да можеш да влезеш в системата
        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('123456789'),
            ]
        );

        if (!$admin->is_admin) {
            $admin->is_admin = true;
            $admin->save();
        }

    // 2. Създаваме няколко примерни Места (Venues), за да не е празно менюто
    \App\Models\Venue::create([
        'name' => 'Народен Театър "Иван Вазов"',
        'city' => 'София',
        'address' => 'ул. Дякон Игнатий 5'
    ]);

    \App\Models\Venue::create([
        'name' => 'Античен Театър',
        'city' => 'Пловдив',
        'address' => 'Стария град'
    ]);

    \App\Models\Venue::create([
        'name' => 'Драматичен театър "Сава Огнянов"',
        'city' => 'Русе',
        'address' => 'пл. Свобода 4'
    ]);
        $types = [
            'Стандартен',
            'Студент',
            'Дете',
            'VIP'
        ];

        foreach (\App\Models\Performance::all() as $performance) {
            if ($performance->ticketTypes()->count() === 0) {
                foreach ($types as $t) {
                    $performance->ticketTypes()->create([
                        'name' => $t,
                        'price' => 0,
                    ]);
                }
            }
        }
    }
}
