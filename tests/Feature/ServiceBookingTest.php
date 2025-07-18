<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceBookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_schedule_service_with_new_vehicle(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $status = Status::create(['name' => 'Na čekanju']);

        $response = $this->actingAs($client)->post(route('client.services.store'), [
            'new_licence_plate' => 'BG123ZZ',
            'new_make' => 'Audi',
            'new_model' => 'A6',
            'new_year' => '2020-01-01',
            'name' => 'Lakiranje prednjeg branika',
            'description' => 'Siva metalik',
        ]);

        $response->assertRedirect(route('client.services.index'));
        $this->assertDatabaseHas('services', [
            'name' => 'Lakiranje prednjeg branika',
        ]);
    }
}
