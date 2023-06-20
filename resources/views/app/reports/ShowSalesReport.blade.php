<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Sales Report')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <form>
                    <div class="flex items-center w-full mb-4">
                        <x-inputs.text name="sales_id" value="{{ $salesId ?? '' }}"
                            placeholder="{{ __('Search by Sales Id') }}" autocomplete="off" class="rounded-l-md">
                        </x-inputs.text>



                        <div class="ml-1">
                            <button type="submit" class="button button-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <form>
                    <div class="flex items-center w-full mb-4">
                        <x-inputs.text name="user_id" value="{{ $userId ?? '' }}"
                            placeholder="{{ __('Search by User Id') }}" autocomplete="off" class="rounded-l-md">
                        </x-inputs.text>
                        <div class="ml-1">
                            <button type="submit" class="button button-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-white border">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left">Sale Id</th>
                                <th class="px-4 py-3 text-left">User</th>
                                <th class="px-4 py-3 text-left">Payment Method</th>
                                <th class="px-4 py-3 text-left">Subtotal Sales</th>
                                <th class="px-4 py-3 text-left">Service Tax</th>
                                <th class="px-4 py-3 text-left">Total Sales</th>
                                <th class="px-4 py-3 text-left">Status</th>
                                <th class="px-4 py-3 text-left">Refunded Reason</th>
                                <th class="px-4 py-3 text-left">Created at</th>
                                <th class="px-4 py-3 text-left">Updated at</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($secondTableData as $secondTableDatas)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-3">{{ $secondTableDatas->id }}</td>
                                    <td class="px-4 py-3">{{ $secondTableDatas->user_id }}</td>
                                    <td class="px-4 py-3">{{ $secondTableDatas->payment_method_id }}</td>
                                    <td class="px-4 py-3">{{ $secondTableDatas->subtotal_sales }}</td>
                                    <td class="px-4 py-3">{{ $secondTableDatas->service_tax }}</td>
                                    <td class="px-4 py-3">{{ $secondTableDatas->total_sales }}</td>
                                    <td class="px-4 py-3">{{ $secondTableDatas->status }}</td>
                                    <td class="px-4 py-3">{{ $secondTableDatas->refunded_reason }}</td>
                                    <td class="px-4 py-3">{{ $secondTableDatas->created_at }}</td>
                                    <td class="px-4 py-3">{{ $secondTableDatas->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
