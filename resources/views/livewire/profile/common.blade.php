<div>
    <form wire:submit.prevent="updateProfile">
        <div class="mb-4">
            <div class="mb-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input wire:model="user.name" type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Test" required>

                @if($errors->has('user.name'))
                    <span class="text-sm font-medium text-red-500">{{ $errors->first('user.name') }}</span>
                @endif
            </div>
            <div class="mb-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input wire:model="user.email" type="email" name="email" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="test@test.ru" required>
                @if($errors->has('user.email'))
                    <span class="text-sm font-medium text-red-500">{{ $errors->first('user.email') }}</span>
                @endif
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 sm:px-6 flex">
            @if($success)
                <div class="py-2 px-4 bg-green-500 text-sm font-medium rounded-md text-white">
                    Successfully saved.
                </div>
            @endif
            <button type="submit" class="ml-auto inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save
            </button>
        </div>
    </form>
</div>
