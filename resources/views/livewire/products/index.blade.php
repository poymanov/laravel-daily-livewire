<div>
    <div class="mb-5 bg-white sm:rounded-lg p-5">
        @include('livewire.products._filter')
    </div>

    <div class="">
        <table class="min-w-full divide-y divide-gray-200 bg-white sm:rounded-lg">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Description
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Category
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($products as $product)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $product->name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $product->description }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $product->category->name }}
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
