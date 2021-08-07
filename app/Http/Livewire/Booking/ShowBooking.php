<?php

namespace App\Http\Livewire\Booking;

use App\Models\Appointment;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;

class ShowBooking extends Component
{
    public $appointment;

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment->load('user');

        if (request()->token !== $appointment->token) {
            throw new AuthorizationException();
        }
    }

    public function render()
    {
        return view('livewire.booking.show-booking');
    }

    public function cancelBooking()
    {
        $this->appointment->update([
            'cancelled_at' => now()
        ]);
    }
}