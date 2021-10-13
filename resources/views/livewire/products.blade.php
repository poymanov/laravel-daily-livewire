<div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Name
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Description
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
            </tr>
        @endforeach
        </tbody>
    </table>

    @if($products->lastPage() > 1)
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-b-lg border-t-2">
            <div class="p-4">
                {{ $products->links() }}
            </div>
        </div>
    @endif
</div>
