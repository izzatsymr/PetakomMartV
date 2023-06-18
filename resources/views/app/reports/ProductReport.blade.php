<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Product Report')
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
                                        placeholder="{{ __('Search by product name') }}" autocomplete="off"></x-inputs.text>

                                        <div class="ml-1">
                                            <button type="submit" class="button button-primary">
                                                <i class="icon ion-md-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                        <div class="md:w-1/2 text-right">
                            <!-- Add any additional filters here -->
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('ID')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('Name')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('Price')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('Stock Quantity')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('Created At')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('Updated At')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($datas as $data)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-left">
                                        {{ $data->id ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 text-left">
                                        {{ $data->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        {{ $data->price ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        {{ $data->stock_quantity ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        {{ $data->created_date ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        {{ $data->updated_date ?? '-' }}
                                    </td>
                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
