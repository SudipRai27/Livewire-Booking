<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::firstOrCreate([
            'name' => 'Coding Session',
            'duration' => 120
        ]);

        Service::firstOrCreate([
            'name' => 'Mentorship Session',
            'duration' => 60
        ]);

        Service::firstOrCreate([
            'name' => 'Training Session',
            'duration' => 30
        ]);
    }
}