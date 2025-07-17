<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
            ]);

        $this->call(StatusSeeder::class);
        $this->call(VehicleSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(BillSeeder::class);
        $this->call(UserSeeder::class);
    }
}
