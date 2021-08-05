<?php

namespace App\Booking\Filters;

use App\Booking\Filter;
use Carbon\CarbonPeriod;
use App\Booking\TimeSlotGenerator;
use Illuminate\Support\Collection;

class UnavailabilityFilter implements Filter
{
    private $unavailabilities;

    public function __construct(Collection $unavailabilities)
    {
        $this->unavailabilities = $unavailabilities;
    }

    //adding filters for lunch break unavilabalities and accounting for before and after times
    public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval)
    {
        //carbon method to add filter on carbon period intervals
        $interval->addFilter(function ($slot) use ($generator) {
            foreach ($this->unavailabilities as $unavailability) {
                if ($slot->between(
                    $unavailability->schedule->date->setTimeFrom(
                        $unavailability->start_time->subMinutes($generator->service->duration - $generator::INCREMENT)
                    ),
                    $unavailability->schedule->date->setTimeFrom($unavailability->end_time->subMinutes($generator::INCREMENT)),
                )) {
                    return false;
                }
            }
            return true;
        });
    }
}