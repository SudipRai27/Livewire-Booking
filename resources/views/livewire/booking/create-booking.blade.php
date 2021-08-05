<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="bg-gray-200 max-w-sm mz-auto m-6 p-5 rounded-lg">
                    <form>
                        <div class="mb-6">
                            <label for="" class="inline-block text-gray-700 font-bold mb-2">Select Service</label>
                            <select name="service" id="service" class="bg-white h-10 w-full border-none rounded-lg"
                                wire:model="state.service">
                                <option value="">Select a service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                            <label for=""></label>
                        </div>
                        <div class="mb-6 {{ !$employees->count() ? 'opacity-25' : ' ' }}">
                            <label for="" class=" inline-block text-gray-700 font-bold mb-2">Select employee</label>
                            <select name="service" id="service" class="bg-white h-10 w-full border-none rounded-lg"
                                wire:model="state.employee" {{ !$employees->count() ? 'disabled="disabled"  ' : '' }}>
                                <option value="">Select an employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            <label for=""></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
