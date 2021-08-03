<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class RegisterName extends Component
{
    public $state = [];

    protected $rules = [
        'state.name' => 'required|max:255'
    ];

    protected $messages = [
        'state.name.required' => 'The name is required',
        'state.name.max' => 'The max character allowed is 255'
    ];

    public function render()
    {
        return view('livewire.auth.register-name');
    }

    public function submit()
    {
        $this->validate();
        $this->emit('goToStep', 2);
    }

    public function updatedState()
    {
        $this->emit('merge', $this->state);
    }
}