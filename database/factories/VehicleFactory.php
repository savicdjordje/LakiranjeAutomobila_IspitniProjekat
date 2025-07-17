<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'licence_plate' => fake()->text(255),
            'make' => fake()->name(),
            'model' => fake()->sentence(15),
            'year' => fake()->date(),
            'client_id' => \App\Models\User::factory(),
        ];
    }
}
