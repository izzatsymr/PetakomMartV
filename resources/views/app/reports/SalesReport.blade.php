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
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text name="search" value="{{ $search ?? '' }}"
                                        placeholder="{{ __('Search by user id') }}" autocomplete="off">
                                    </x-inputs.text>

                                    <div class="ml-1">
                                        <button type="submit" class="button button-primary">
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">

                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('Sales Date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('User ID')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('Total Sales')
                                </th>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @foreach ($datas as $data)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-left">
                                        {{ $data->created_at ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $data->user_id ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        {{ $data->total_sales ?? '-' }}
                                    </td>
                                  
                                    <td class="px-4 py-3 text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions"
                                            class="relative inline-flex align-middle">
                                            <a href="{{ route('reports.ShowSalesReport', $data->user_id) }}" class="mr-1">
                                                <button type="button" class="button">
                                                    <i class="icon ion-md-eye"></i>
                                                </button>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($datas->isEmpty())
                                <tr>
                                    <td colspan="9">
                                        @lang('No items found.')
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
