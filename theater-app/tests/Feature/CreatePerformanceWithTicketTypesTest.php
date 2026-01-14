<?php

namespace Tests\Feature;

use App\Models\Performance;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreatePerformanceWithTicketTypesTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_performance_with_ticket_types()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.performances.store'), [
            'title' => 'Test Show',
            'date' => now()->format('Y-m-d'),
            'venue_id' => \App\Models\Venue::factory()->create()->id,
            'photo' => UploadedFile::fake()->image('poster.jpg'),
            'ticket_types' => [
                'standard' => '20.00',
                'student' => '15.00',
                'child' => '10.00',
                'vip' => '50.00'
            ]
        ]);

        $response->assertRedirect(route('admin.performances.index'));

        $this->assertDatabaseHas('performances', ['title' => 'Test Show']);

        $performance = Performance::where('title', 'Test Show')->first();

        $this->assertDatabaseHas('ticket_types', ['performance_id' => $performance->id, 'name' => 'Стандартен', 'price' => 20.00]);
        $this->assertDatabaseHas('ticket_types', ['performance_id' => $performance->id, 'name' => 'Студент', 'price' => 15.00]);
        $this->assertDatabaseHas('ticket_types', ['performance_id' => $performance->id, 'name' => 'Дете', 'price' => 10.00]);
        $this->assertDatabaseHas('ticket_types', ['performance_id' => $performance->id, 'name' => 'VIP', 'price' => 50.00]);
    }
}
