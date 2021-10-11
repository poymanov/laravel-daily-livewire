<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-start">
                <div class="w-2/4 overflow-hidden col-span-2 mr-6">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Common
                            </h3>
                        </div>
                        <div class="border-t border-gray-200 p-6">
                            @livewire('profile.common')
                        </div>
                    </div>
                </div>
                <div class="w-2/4 overflow-hidden col-span-2 mr-6">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Password
                            </h3>
                        </div>
                        <div class="border-t border-gray-200 p-6">
                            @livewire('profile.password')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
