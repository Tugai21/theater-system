<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Performance;
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

    // 3. Създаваме примерни Постановки (Performances)
    \App\Models\Performance::create([
        'title' => 'Хамлет',
        'date' => now()->addDays(7),
        'venue_id' => 1,
        'image_path' => 'posters/hamlet.jpg',
        'description' => 'Класическата трагедия на Шекспир'
    ]);

    \App\Models\Performance::create([
        'title' => 'Ромео и Жулиета',
        'date' => now()->addDays(14),
        'venue_id' => 2,
        'image_path' => 'posters/romeo.jpg',
        'description' => 'Любовната история на всички времена'
    ]);

    \App\Models\Performance::create([
        'title' => 'Макбет',
        'date' => now()->addDays(21),
        'venue_id' => 3,
        'image_path' => 'posters/macbeth.jpg',
        'description' => 'Шотландска трагедия'
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
