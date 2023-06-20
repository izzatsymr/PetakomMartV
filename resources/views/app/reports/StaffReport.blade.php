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
                                    <x-inputs.text name="user_id" value="{{ $user_id ?? '' }}"
                                        placeholder="{{ __('Search by User ID') }}" autocomplete="off"></x-inputs.text>
                                    <div class="ml-1">
                                        <button type="submit" class="button button-primary">
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>

                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-white rounded shadow-md">
                        <thead class="text-gray-700 bg-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('Schedule date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('Start Time')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('End Time')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('User ID')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('User Name')
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($datas as $data)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-3 text-left">
                                        {{ $data->created_at ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $data->start_time ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $data->end_time ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $data->id ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $data->name ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
