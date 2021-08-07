<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-gray-200 max-w-sm mx-auto m-6 p-5 rounded-lg">
                        <div class="mb-6">
                            <div class="text-gray-700 font-bold mb-2">
                                {{ $appointment->user->name ?? '' }}, Thanks for your booking
                            </div>
                        </div>

                        <div class="border-t border-b border-gray-200 py-2">
                            <div class="font-semibold">
                                {{ $appointment->service->name ?? '' }}
                                {{ $appointment->service->duration ?? '' }} minutes with
                                {{ $appointment->employee->name ?? '' }}
                            </div>
                            <div class="text-gray-700">
                                on {{ $appointment->date->format('D jS M y') }} at
                                {{ $appointment->start_time->format('g:i A') }}
                            </div>
                        </div>
                        @if (!$appointment->isCancelled())
                            <button type="button"
                                class="text-white hover:text-gray-400 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                x-data="{
                                confirmCancellation() {
                                    if(window.confirm('Are you sure')) {
                                        @this.call('cancelBooking')
                                    }
                                }
                            }" x-on:click="confirmCancellation">
                                Cancel Booking
                            </button>
                        @else
                            <p>Your booking has been cancelled</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
