<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Status;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeStatusUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_can_update_status(): void
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $client = User::factory()->create(['role' => 'client']);
        $vehicle = Vehicle::factory()->create(['client_id' => $client->id]);
        $status1 = Status::create(['name' => 'Na čekanju']);
        $status2 = Status::create(['name' => 'U obradi']);

        $service = Service::create([
            'vehicle_id' => $vehicle->id,
            'employee_id' => $employee->id,
            'admin_id' => null,
            'status_id' => $status1->id,
            'name' => 'Lakiranje haube',
            'description' => 'Zelena',
        ]);

        $response = $this->actingAs($employee)->post(route('employee.services.status', $service), [
            'status_id' => $status2->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'status_id' => $status2->id,
        ]);
    }
}
