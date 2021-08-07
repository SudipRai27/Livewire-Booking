<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-gray-200 max-w-sm mz-auto m-6 p-5 rounded-lg">
                        <div>
                            @if (session()->has('message'))
                                <div class="alert alert-success bg-green-700 text-white p-2 rounded-lg">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                        <form wire:submit.prevent="createBooking">
                            <div class="mb-6">
                                <label for="" class="inline-block text-gray-700 font-bold mb-2">Select Service</label>
                                <select name="service" id="service" class="bg-white h-10 w-full border-none rounded-lg"
                                    wire:model="state.service">
                                    <option value="">Select a service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }} -
                                            {{ $service->duration }} mins</option>
                                    @endforeach
                                </select>
                                <label for=""></label>
                            </div>
                            <div class="mb-6 {{ !$employees->count() ? 'opacity-25' : ' ' }}">
                                <label for="" class=" inline-block text-gray-700 font-bold mb-2">Select employee</label>
                                <select name="service" id="service" class="bg-white h-10 w-full border-none rounded-lg"
                                    wire:model="state.employee"
                                    {{ !$employees->count() ? 'disabled="disabled"  ' : '' }}>
                                    <option value="">Select an employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                                <label for=""></label>
                            </div>

                            <div
                                class="mb-6 {{ !$this->selectedService || !$this->selectedEmployee ? 'opacity-25' : ' ' }}">
                                <label for="" class=" inline-block text-gray-700 font-bold mb-2">Select appointment
                                    time</label>
                                @livewire('booking.booking-calendar', [
                                'service'=>$this->selectedService,
                                'employee'=>$this->selectedEmployee
                                ],key(optional($this->selectedEmployee)->id))
                            </div>
                            @if ($this->hasDetailToBook)
                                <div class="mb-6">
                                    <div class="tex-gray-700 font-bold mb-2">
                                        You're ready to book
                                    </div>
                                    <div class="border-t border-b border-gray-300 py-2">
                                        {{ $this->selectedService->name }} ({{ $this->selectedService->duration }}
                                        minutes)
                                        with
                                        {{ $this->selectedEmployee->name }}
                                        on {{ $this->timeObject->format('D jS M Y') }} at
                                        {{ $this->timeObject->format('g:i a') }}
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit"
                                            class="text-white hover:text-gray-400 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            Confirm Booking
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
