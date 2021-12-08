<div class="p-5">
    <form action="{{ route('dropdown.submit') }}" method="post">
        @csrf
        <div class="mb-4">
            <div class="mb-2">
                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>

                <select name="country" id="country" wire:model="country"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        required>
                    <option value="">-- choose country --</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-4">
            <div class="mb-2">
                <label for="city" class="block text-sm font-medium text-gray-700">City</label>

                <select name="city" id="country" wire:model="city"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        required>
                    @if($cities->count() == 0)
                    <option value="">-- choose country first--</option>
                    @endif

                    @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 sm:px-6 flex">
            <button type="submit"
                    class="ml-auto inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
            </button>
        </div>
    </form>
</div>
