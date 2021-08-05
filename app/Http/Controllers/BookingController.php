<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Service;
use App\Models\Schedule;

class BookingController extends Controller
{
    public function create()
    {
        $schedule = Schedule::find(1);
        $service = Service::find(2);

        $employee = Employee::find(1);
        $slots = $employee->availableTimeSlots($schedule, $service);

        return view('booking.create', [
            'slots' => $slots
        ]);
    }
}