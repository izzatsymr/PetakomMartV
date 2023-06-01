
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Report Dashboard')
        </h2>
    </x-slot>

    <div class="container mx-auto mt-16 px-4">
        <!-- Report Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="rounded-lg overflow-hidden shadow-md">
                <a href="{{ route('reports.ProductReport') }}">
                    <img class="Productreport-image" src="https://icons.veryicon.com/png/o/miscellaneous/fu-jia-intranet/product-29.png">
                </a>
                <h3 class="text-center mt-4 text-lg font-semibold">Product Report</h3>
            </div>
            <div class="rounded-lg overflow-hidden shadow-md">
                <a href="{{ route('reports.SalesReport') }}">
                    <img class="Salesreport-image" src="https://cdn-icons-png.flaticon.com/512/1585/1585258.png" alt="Sales Report">
                </a>
                <h3 class="text-center mt-4 text-lg font-semibold">Sales Report</h3>
            </div>
            <div class="rounded-lg overflow-hidden shadow-md">
                <a href="{{ route('reports.StaffReport') }}">
                    <img class="Staffreport-image" src="https://icons.veryicon.com/png/o/internet--web/prejudice/user-128.png" alt="Staff Report">
                </a>
                <h3 class="text-center mt-4 text-lg font-semibold">Staff Report</h3>
            </div>
        </div>
    </div>

</x-app-layout>

</body>
</html>

