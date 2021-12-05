<div>
    <div class="mb-5 bg-white sm:rounded-lg p-5">
        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create</a>
    </div>

    <div class="mb-5 bg-white sm:rounded-lg p-5">
        @include('livewire.products._filter')
    </div>

    <div wire:loading.block class="mb-5 sm:rounded-lg p-3 font-medium bg-green-500 text-white">
        Loading data...
    </div>

    <div>
        <table class="min-w-full divide-y divide-gray-200 bg-white sm:rounded-lg">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Photo
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Description
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Category
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Color
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    In Stock?
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Stock Date
                </th>
                <th scope="col" class="relative px-6 py-3"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($products as $product)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        @if($product->photoUrl)
                            <img src="{{ $product->photoUrl }}" alt="{{ $product->name }} photo" width="50">
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $product->name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $product->description }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <ul class="list-disc">
                            @foreach($product->categories as $category)
                                <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $product->colorLabel }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $product->inStockLabel }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $product->stock_date }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 flex">
                        <a href="{{ route('products.edit', compact('product')) }}" class="mr-2 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Edit</a>
                        <a onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="deleteProduct({{ $product->id }})" href="" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @if($products->lastPage() > 1)
        <div class="bg-white overflow-hidden sm:rounded-lg mt-4">
            <div class="p-4">
                {{ $products->links() }}
            </div>
        </div>
    @endif
</div>
