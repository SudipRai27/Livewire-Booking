<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class RegisterEmail extends Component
{
    public $state = [];

    protected $rules = [
        'state.email' => 'required|email|max:255|unique:users,email'
    ];

    protected $messages = [
        'state.email.email' => 'The email must be an email',
        'state.email.required' => 'The email is required',
        'state.email.max' => 'The max character allowed is 255',
        'state.email.unique' => 'The email is already taken'
    ];


    public function render()
    {
        return view('livewire.auth.register-email');
    }

    public function submit()
    {
        $this->validate();
        $this->emit('goToStep', 3);
    }

    public function updatedState()
    {
        $this->emit('merge', $this->state);
    }
}