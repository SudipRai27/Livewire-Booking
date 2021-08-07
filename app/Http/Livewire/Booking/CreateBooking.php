<?php

namespace App\Http\Livewire\Booking;

use App\Models\Appointment;
use Carbon\Carbon;
use App\Models\Service;
use Livewire\Component;
use App\Models\Employee;

class CreateBooking extends Component
{
    public $employees;

    public $state = [
        'service' => '',
        'employee' => '',
        'time' => ''
    ];

    protected $listeners = [
        'updated-booking-time' => 'setTime',
        'refreshComponent' => '$refresh'
    ];

    public function mount()
    {
        $this->employees = collect();
    }

    public function setTime($time)
    {
        $this->state['time'] = $time;
    }

    public function updatedStateService($serviceId)
    {
        $this->state['employee'] = '';
        if (!$serviceId) {
            $this->employees = collect();
            return;
        }
        $this->clearTime();
        $this->employees = $this->selectedService->employees;
    }

    public function updatedStateEmployee()
    {
        $this->clearTime();
    }

    public function clearTime()
    {
        $this->state['time'] = '';
    }

    public function getSelectedServiceProperty()  // this automatically registers a $this->selectedService getter
    {
        if (!$this->state['service']) {
            return null;
        }
        return Service::find($this->state['service']);
    }

    public function getSelectedEmployeeProperty()  // this automatically registers a $this->selectedEmployee getter
    {
        if (!$this->state['employee']) {
            return null;
        }
        return Employee::find($this->state['employee']);
    }

    public function getHasDetailToBookProperty()
    {
        return $this->state['service'] && $this->state['employee'] && $this->state['time'];
    }

    public function getTimeObjectProperty()
    {
        return Carbon::createFromTimeStamp($this->state['time']);
    }

    protected function rules()
    {
        return [
            'state.service' => ['required', 'exists:services,id'],
            'state.employee' => ['required', 'exists:employees,id'],
            'state.time' => ['required', 'numeric']
        ];
    }

    public function createBooking()
    {
        $this->validate();
        $appointment = Appointment::make([
            'date' => $this->timeObject->toDateString(),
            'start_time' => $this->timeObject->toTimeString(),
            'end_time' => $this->timeObject
                ->clone()
                ->addMinutes($this->selectedService->duration)
                ->toTimeString(),
            'user_id' => auth()->user()->id
        ]);

        $appointment->service()->associate($this->selectedService);
        $appointment->employee()->associate($this->selectedEmployee);
        $appointment->save();
        session()->flash('message', 'Booking created successfully');
        return redirect()->to(route('booking.show', $appointment->uuid) . '?token=' . $appointment->token);
        // $this->reset('state');
        // $this->emitSelf('refreshComponent');
    }

    public function render()
    {
        $services  = Service::get();
        return view('livewire.booking.create-booking', [
            'services' => $services
        ]);
    }
}