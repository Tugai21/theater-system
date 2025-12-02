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
    \App\Models\User::factory()->create([
        'name' => 'Тугай Хасан',
        'email' => 'tugaytanju3@gmail.com',
        'password' => bcrypt('123456789'), // Паролата ще е 'password'
    ]);

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
}
}
