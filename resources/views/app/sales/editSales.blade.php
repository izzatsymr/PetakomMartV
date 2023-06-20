<div class="overlay-container">
    <div class="overlay-content">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.sales.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('sales.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
                </x-slot>

                <x-form method="POST" action="{{ route('sales.update', $sale) }}" class="mt-4">
                    @method('PUT')
                    @csrf
                    <div class="flex flex-wrap">
                        <x-inputs.group class="w-full">
                            <label for="status" class="block font-medium text-gray-700">Status</label>
                            <select id="status" name="status" class="form-input w-full">
                                <option value="completed" {{ $sale->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="refunded" {{ $sale->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </x-inputs.group>

                        <x-inputs.group class="w-full">
                            <x-inputs.textarea name="refunded_reason" label="Refunded Reason" maxlength="255">{{ $sale->refunded_reason }}</x-inputs.textarea>
                        </x-inputs.group>
                    </div>

                    <div class="mt-10">
                        <a href="{{ route('sales.index') }}" class="button">
                            <i class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "></i>
                            @lang('crud.common.back')
                        </a>

                        <a href="{{ route('sales.create') }}" class="button">
                            <i class="mr-1 icon ion-md-add text-primary"></i>
                            @lang('crud.common.create')
                        </a>

                        <button type="submit" class="button button-primary float-right">
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>