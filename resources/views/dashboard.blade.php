<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-6xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative text-center">
                    <h1 style="font-size: 50px; margin-bottom: 20px;">
                        Welcome To Petakom Mart
                    </h1>
                    <img src="{{ asset('images/petakom.png') }}" alt="Petakom" class="mx-auto" style="width: 500px; margin-top: -130px;">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
