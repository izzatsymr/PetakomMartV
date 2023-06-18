<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Sales Report')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">

                        <div class="md:w-1/2 text-right">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.date name="start_date" value="{{ $start_date ?? '' }}"
                                        placeholder="{{ __('Start Date') }}" autocomplete="off">
                                    </x-inputs.date>

                                    <div class="ml-2 mr-2">-</div>

                                    <x-inputs.date name="end_date" value="{{ $end_date ?? '' }}"
                                        placeholder="{{ __('End Date') }}" autocomplete="off">
                                    </x-inputs.date>

                                    <div class="ml-1">
                                        <button type="submit" class="button button-primary">
                                            <i class="icon ion-md-filter"></i>
                                            {{ __('Filter') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <table class="w-full max-w-full mb-4 bg-transparent">
                    <thead class="text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left">Sale Date</th>
                            <th class="px-4 py-3 text-left">Total Sales</th>
                            <th class="px-4 py-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @foreach ($sales as $sale)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">{{ $sale->sale_date }}</td>
                                <td class="px-4 py-3 text-left">{{ $sale->total_sales }}</td>
                                <td class="px-4 py-3 text-left">
                                    @can('view')
                                        <a href="{{ route('reports.ShowSalesReport', ['date' => $sale->sale_date]) }}">
                                            <button type="button" class="button">
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-partials.card>
            <!-- Pass $secondTableData and $selectedDate to ShowSalesReport.blade.php -->
            
        </div>
    </div>
</x-app-layout>
