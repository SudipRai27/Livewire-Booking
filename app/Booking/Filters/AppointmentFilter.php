<?php

namespace App\Booking\Filters;

use App\Booking\Filter;
use App\Booking\TimeSlotGenerator;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

class AppointmentFilter implements Filter
{
    public $appointments;

    public function __construct(Collection $appointments)
    {
        $this->appointments = $appointments;
    }

    public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval)
    {
        //carbon method to add filter on carbon period intervals
        $interval->addFilter(function ($slot) use ($generator) {
            foreach ($this->appointments as $appointment) {
                if ($slot->between(
                    $appointment->date->setTimeFrom(
                        $appointment->start_time->subMinutes($generator->service->duration - $generator::INCREMENT)
                    ),
                    $appointment->date->setTimeFrom(
                        $appointment->end_time
                    ),
                )) {
                    return false;
                }
            }
            return true;
        });
    }
}