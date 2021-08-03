<div>
    <form action="">
        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input type="text"
                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                name="email" wire:model.debounce.500ms="state.email">

            @error('state.email')
                <p style="color:red;">
                    {{ $message }}
                </p>
            @enderror

        </div>
        <div class="mt-4" style="display: flex; justify-content:space-between">
            <a href="#" wire:click.prevent="$emit('goToStep',1)">Go Back</a>
            <x-button class="ml-" wire:click.prevent="submit">
                {{ __('Next') }}
            </x-button>
        </div>
    </form>
</div>
