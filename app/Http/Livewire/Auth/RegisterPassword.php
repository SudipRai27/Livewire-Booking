<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class RegisterPassword extends Component
{
    public $state = [];

    protected $rules = [
        'state.password' => 'required|min:6'
    ];

    protected $messages = [
        'state.password.required' => 'The password is required',
        'state.password.min' => 'The min length of password is 6',
    ];

    public function render()
    {
        return view('livewire.auth.register-password');
    }

    public function submit()
    {
        $this->validate();
        $this->emit('store');
    }

    public function updatedState()
    {
        $this->emit('merge', $this->state);
    }
}