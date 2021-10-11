<div>
    <form wire:submit.prevent="updatePassword">
        <div class="mb-4">
            <div class="mb-2">
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input wire:model="password" type="password" name="password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>

                @if($errors->has('password'))
                    <span class="text-sm font-medium text-red-500">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="mb-2">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Repeat New Password</label>
                <input wire:model="passwordConfirmation" type="password" name="password_confirmation" id="password_confirmation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                @if($errors->has('passwordConfirmation'))
                    <span class="text-sm font-medium text-red-500">{{ $errors->first('passwordConfirmation') }}</span>
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
