<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;

class ProfileEmail extends Component
{
    public $state = [];

    public $user;

    public function mount(User $user)
    {
        $this->user = $user->withoutRelations();
    }

    protected function rules()
    {
        return [
            'state.email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $this->user->id,
            ]
        ];
    }

    protected $messages = [
        'state.email.email' => 'The email must be an email',
        'state.email.required' => 'The email is required',
        'state.email.max' => 'The max character allowed is 255',
        'state.email.unique' => 'The email is already taken'
    ];


    public function render()
    {
        return view('livewire.profile.profile-email');
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