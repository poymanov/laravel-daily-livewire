<div class="p-5">
    <form action="{{ route('multiply-input.submit') }}" method="post">
        @csrf
        <div class="mb-4">
            <div class="mb-2">
                <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer name</label>
                <input wire:model="customer_name" type="text" name="customer_name" id="customer_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
            </div>
            <div class="mb-2">
                <label for="customer_email" class="block text-sm font-medium text-gray-700">Customer email</label>
                <input wire:model="customer_email" type="email" name="customer_email" id="customer_email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
            </div>
        </div>
        <div class="mb-4">
            <h3 class="mb-2">Products</h3>

            <table class="min-w-full divide-y divide-gray-200 bg-white sm:rounded-lg mb-3">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Product
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Quantity
                    </th>
                    <th scope="col" class="relative px-6 py-3"></th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                @foreach($orderProducts as $index => $orderProduct)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <select name="orderProducts[{{ $index }}][product_id]" wire:model="orderProducts.{{ $index }}.product_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                <option value="">-- choose product --</option>
                                @foreach($allProducts as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->price }}$)</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <input type="text" name="orderProducts[{{ $index }}][quantity]" wire:model="orderProducts.{{ $index }}.quantity" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <a wire:click.prevent="removeProduct({{ $index }})" href="#" class="text-indigo-600 hover:text-indigo-900 mr-2">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mb-5 sm:rounded-lg">
                <a href="#" wire:click.prevent="addProduct" class="p-2 border border-transparent rounded-md shadow-sm text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add Another Product</a>
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 sm:px-6 flex">
            <button type="submit" class="ml-auto inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save Order
            </button>
        </div>
    </form>
</div>
