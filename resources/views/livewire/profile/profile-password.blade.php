<div>
    <form action="#">
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
            <input type="password"
                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                name="password" wire:model.debounce.500ms="state.password">
            @error('state.password')
                <p style="color:red;">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mt-4" style="display: flex; justify-content:space-between">
            <a href="#" wire:click.prevent="$emit('goToStep',2)">Go Back</a>
            <x-button class="ml-" wire:click.prevent="submit">
                {{ __('Update') }}
            </x-button>
        </div>
    </form>
</div>
