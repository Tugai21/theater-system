<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VenueTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_venue()
    {
        $admin = User::factory()->create();
        $admin->is_admin = true;
        $admin->save();

        $this->actingAs($admin)
            ->post(route('admin.venues.store'), [
                'name' => 'Малък театър',
                'city' => 'София',
                'address' => 'ул. Пример 1',
            ])
            ->assertRedirect(route('admin.venues.index'));

        $this->assertDatabaseHas('venues', [
            'name' => 'Малък театър',
            'city' => 'София',
            'address' => 'ул. Пример 1',
        ]);
    }
}
