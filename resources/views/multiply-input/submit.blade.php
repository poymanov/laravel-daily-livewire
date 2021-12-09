<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Multiply Input Submit Result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <div class="p-2">
                                    <p class="mb-2">
                                        Customer name: {{ $customerName }}
                                    </p>
                                    <p class="mb-2">
                                        Customer email: {{ $customerEmail }}
                                    </p>
                                    <hr class="mb-3">
                                    <div>
                                        <h3 class="font-bold mb-2">Products</h3>
                                        @foreach($orderProducts as $orderProduct)
                                            <div class="mb-2">
                                                Product: {{ $orderProduct['product_id'] }}
                                                Quantity: {{ $orderProduct['quantity'] }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
