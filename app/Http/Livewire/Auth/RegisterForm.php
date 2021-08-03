<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class RegisterForm extends Component
{
    public $step = 1;

    public $state = [];

    protected $listeners = [
        'goToStep',
        'merge',
        'store'
    ];

    public function goToStep($step)
    {
        $this->step = $step;
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }

    public function merge($state)
    {
        $this->state = array_merge($this->state, $state);
    }

    public function store()
    {
        User::create([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'password' => Hash::make($this->state['password']),
            'email_verified_at' => now()
        ]);
        $this->state = [];
        $this->goToStep(1);
        session()->flash('message', 'Registered Successfully. You can now login');
    }
}