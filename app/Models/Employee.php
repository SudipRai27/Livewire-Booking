<?php

namespace App\Models;

use App\Booking\TimeSlotGenerator;
use Illuminate\Database\Eloquent\Model;
use App\Booking\Filters\AppointmentFilter;
use App\Booking\Filters\UnavailabilityFilter;
use App\Booking\Filters\SlotsPassedTodayFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function services()
    {
        return $this->belongsToMany(Service::class)
            ->withTimestamps();
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function availableTimeSlots(Schedule $schedule, Service $service)
    {
        return (new TimeSlotGenerator($schedule, $service))
            ->applyFilters([
                new SlotsPassedTodayFilter,
                new UnavailabilityFilter($schedule->unavailabilites),
                new AppointmentFilter($this->appointmentsForDate($schedule->date))
            ])
            ->get();
    }

    public function appointmentsForDate(Carbon $date)
    {
        return $this->appointments()->whereDate('date', $date)->get();
    }
}