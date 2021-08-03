<div>
    <form action="#">
        <div class="mt-4">
            <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
            <input type="text"
                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                name="name" wire:model.defer="state.name">
            @error('state.name')
                <p style="color:red;">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mt-4" style="display: flex; justify-content:space-between">
            <a href="{{ route('login') }}">Go to Login</a>
            <x-button class="ml-" wire:click.prevent="submit">
                {{ __('Next') }}
            </x-button>
        </div>
    </form>
</div>
