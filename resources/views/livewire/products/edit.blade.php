<div class="p-5">
    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <div class="mb-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input wire:model="product.name" type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Name..." required>

                @if($errors->has('product.name'))
                    <span class="text-sm font-medium text-red-500">{{ $errors->first('product.name') }}</span>
                @endif
            </div>
            <div class="mb-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea wire:model="product.description" name="description" id="description" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Description..." required></textarea>

                @if($errors->has('product.description'))
                    <span class="text-sm font-medium text-red-500">{{ $errors->first('product.description') }}</span>
                @endif
            </div>
            <div class="mb-2">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>

                <select name="category_id" id="category_id" wire:model="product.category_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    <option value="">-- choose category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                @if($errors->has('product.category_id'))
                    <span class="text-sm font-medium text-red-500">{{ $errors->first('product.category_id') }}</span>
                @endif
            </div>
            <div class="mb-2">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Color</label>

                @foreach($colors as $color => $title)
                    <div class="flex items-center">
                        <input wire:model="product.color" type="radio" value="{{ $color }}" name="color" id="color" class="mr-2 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                        <label for="color" class="block text-sm font-medium text-gray-700">{{ $title }}</label>
                    </div>
                @endforeach

                @if($errors->has('product.color'))
                    <span class="text-sm font-medium text-red-500">{{ $errors->first('product.color') }}</span>
                @endif
            </div>
            <div class="mb-2">
                <div class="flex items-center">
                    <input wire:model="product.in_stock" type="checkbox" name="in_stock" id="in_stock" value="1" class="mr-2 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    <label for="in_stock" class="block text-sm font-medium text-gray-700">In Stock?</label>
                </div>

                @if($errors->has('product.in_stock'))
                    <span class="text-sm font-medium text-red-500">{{ $errors->first('product.in_stock') }}</span>
                @endif
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 sm:px-6 flex">
            <button type="submit" class="ml-auto inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update
            </button>
        </div>
    </form>
</div>
