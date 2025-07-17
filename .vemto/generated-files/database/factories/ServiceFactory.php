<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(15),
            'status_id' => \App\Models\Status::factory(),
            'admin_id' => \App\Models\User::factory(),
            'employee_id' => \App\Models\User::factory(),
            'vehicle_id' => \App\Models\Vehicle::factory(),
        ];
    }
}
