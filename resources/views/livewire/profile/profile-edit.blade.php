<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    @if ($step === 1)
        @livewire('profile.profile-name', ['state'=>$state])
    @endif
    @if ($step === 2)
        @livewire('profile.profile-email', ['state'=>$state, 'user' => $user])
    @endif
    @if ($step === 3)
        @livewire('profile.profile-password', ['state'=>$state])
    @endif
</div>
