<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    @if ($step === 1)
        @livewire('auth.register-name', ['state'=>$state])
    @endif
    @if ($step === 2)
        @livewire('auth.register-email', ['state'=>$state])
    @endif
    @if ($step === 3)
        @livewire('auth.register-password', ['state'=>$state])
    @endif
</div>
