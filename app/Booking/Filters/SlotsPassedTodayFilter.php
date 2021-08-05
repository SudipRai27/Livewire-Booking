<?php

namespace App\Booking\Filters;

use App\Booking\Filter;
use Carbon\CarbonPeriod;
use App\Booking\TimeSlotGenerator;

class SlotsPassedTodayFilter implements Filter
{
    public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval)
    {
        //carbon method to add filter on carbon period intervals
        $interval->addFilter(function ($slot) use ($generator) {
            if ($generator->schedule->date->isToday()) {
                if ($slot->lt(now())) { //less than
                    return false;
                }
            }
            return true;
        });
    }
}