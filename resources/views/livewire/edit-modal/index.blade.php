<div>
    <div wire:loading.block class="mb-5 sm:rounded-lg p-3 font-medium bg-green-500 text-white">
        Loading data...
    </div>

    <div>
        <table class="min-w-full divide-y divide-gray-200 bg-white sm:rounded-lg">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Price
                </th>
                <th scope="col" class="relative px-6 py-3"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($products as $product)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $product->name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $product->price }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 flex">
                        <a href="#" wire:click.prevent="edit({{ $product->id }})" class="mr-2 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @includeWhen($showModal, 'livewire.edit-modal.modal', compact('product'))
</div>
