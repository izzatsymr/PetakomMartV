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
                    <h2 style="font-weight: bold; text-decoration: underline; margin-top: -100px;">Introduction </h2>
                    <h2>Petakom Mart is a mini market for the student of Faculty Computer. </h2>
                    <h2>We offer a wide range of quality products and provide excellent customer service. </h2>
                    <h2>Visit us for a convenient and enjoyable shopping experience.</h2>
                    
               
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
