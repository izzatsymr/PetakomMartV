<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Staff Report')
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
                                        placeholder="{{ __('search by staff name') }}" autocomplete="off"></x-inputs.text>

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
                                    @lang('Schedule date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('Total Staff')
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
                                    @lang('Created_at')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('Updated_at')
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
                                        {{ optional($data->category_id)->name ?? '-' }}
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
                                        {{ $data->created_at ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        {{ $data->updated_at ?? '-' }}
                                    </td>
                                    <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('view', $data)
                                        <a
                                            
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"


                                            >   
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan 
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
