<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.sales.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('sales.index') }}" class="mr-4">
                        <i class="mr-1 icon ion-md-arrow-back"></i>
                    </a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sales.inputs.user_id')
                        </h5>
                        <span>{{ optional($sale->user)->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sales.inputs.payment_method_id')
                        </h5>
                        <span>{{ optional($sale->paymentMethod)->name ?? '-' }}</span>
                    </div>

                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            Product Details
                        </h5>
                        <table class="w-full max-w-full mb-4 bg-transparent border border-black">
                            <thead class="text-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left border border-black">Product Name</th>
                                    <th class="px-4 py-3 text-left border border-black">Quantity</th>
                                    <th class="px-4 py-3 text-left border border-black">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sale->products as $product)
                                <tr>
                                    <td class="px-4 py-3 text-left border border-black">{{ $product->name }}</td>
                                    <td class="px-4 py-3 text-left border border-black">{{ $product->pivot->quantity }}</td>
                                    <td class="px-4 py-3 text-left border border-black">{{ $product->pivot->total_price }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sales.inputs.subtotal_sales')
                        </h5>
                        <span>{{ $sale->subtotal_sales ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sales.inputs.service_tax')
                        </h5>
                        <span>{{ $sale->service_tax ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sales.inputs.total_sales')
                        </h5>
                        <span>{{ $sale->total_sales ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sales.inputs.status')
                        </h5>
                        <span>{{ $sale->status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sales.inputs.refunded_reason')
                        </h5>
                        <span>{{ $sale->refunded_reason ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('sales.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Sale::class)
                    <a href="{{ route('sales.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>