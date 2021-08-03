<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ProfileEdit extends Component
{
    public $step = 1;

    public $state = [];

    public $user;

    protected $listeners = [
        'goToStep',
        'merge',
        'update'
    ];

    public function mount(User $user)
    {
        $this->user = $user->withoutRelations()->toArray();
        $this->assignState();
    }

    public function assignState()
    {
        $this->state['email'] = $this->user['email'];
        $this->state['name'] = $this->user['name'];
    }

    public function goToStep($step)
    {
        $this->step = $step;
    }

    public function merge($state)
    {
        $this->state = array_merge($this->state, $state);
    }

    public function render()
    {
        return view('livewire.profile.profile-edit');
    }

    public function update()
    {
        $this->user = tap(User::findOrFail($this->user['id']))->update([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'password' => Hash::make($this->state['password']),
        ])->toArray();
        $this->assignState();
        $this->goToStep(1);
        session()->flash('message', 'Your profile is updated successfully.');
    }
}