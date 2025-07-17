<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Na čekanju',
            'U pripremi',
            'Lakiranje vozila',
            'Problem u procesu',
            'Prekinut proces',
            'Sušenje vozila',
            'Završeno',
            'Plaćeno',
        ];

        foreach ($statuses as $status) {
            Status::create(['name' => $status]);
        }
    }
}
