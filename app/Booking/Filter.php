<?php

namespace App\Booking;

use Carbon\CarbonPeriod;
use App\Booking\TimeSlotGenerator;

interface Filter
{
    public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval);
}