<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Service;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service1 = Service::where('name', 'Coding Session')->first();
        $service2 = Service::where('name', 'Mentorship Session')->first();
        $service3 = Service::where('name', 'Training Session')->first();

        $employee1 = Employee::create([
            'name' => 'Jack'
        ]);

        $employee2 = Employee::create([
            'name' => 'Mabel'
        ]);

        if ($employee1) {
            // Creating schedules for employees
            $employee1->schedules()->createMany([
                [
                    'date' => now()->addDay(1),
                    'start_time'   => '09:00',
                    'end_time'   => '17:00',
                ],
                [
                    'date' => now()->addDay(2),
                    'start_time'   => '09:00',
                    'end_time'   => '17:00',
                ]
            ]);

            $schedule1 = $employee1->schedules->first();

            if ($schedule1) {
                //Creating unavailabilities for schedule
                $schedule1->unavailabilites()->create(
                    [
                        'start_time' => '12:00',
                        'end_time' => '13:00'
                    ]
                );
            }

            if ($service1) {
                //Attaching services to employees
                $employee1->services()->attach($service1->id);
            }

            if ($service2) {
                $employee1->services()->attach($service2->id);
            }
        }

        if ($employee2) {
            $employee2->schedules()->createMany([
                [
                    'date' => now()->addDay(1),
                    'start_time'   => '09:00',
                    'end_time'   => '17:00',
                ],
            ]);

            if ($service3) {
                $employee2->services()->attach($service3->id);
            }
        }
    }
}