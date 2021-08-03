<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class ProfilePassword extends Component
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
        return view('livewire.profile.profile-password');
    }

    public function submit()
    {
        $this->validate();
        $this->emit('update');
    }

    public function updatedState()
    {
        $this->emit('merge', $this->state);
    }
}