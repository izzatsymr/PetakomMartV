<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.inventories.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('inventories.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.inventories.inputs.product_id')
                        </h5>
                        <span>{{ optional($inventory->product)->name ?? '-' }}</span>
                        <!-- Displaying the product name of the inventory item (or '-' if not available) -->
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.inventories.inputs.stock_quantity')
                        </h5>
                        <span>{{ $inventory->stock_quantity ?? '-' }}</span>
                        <!-- Displaying the stock quantity of the inventory item (or '-' if not available) -->
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('inventories.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Inventory::class)
                    <a href="{{ route('inventories.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
