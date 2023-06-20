<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.products.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('products.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <!-- Form to edit an existing product -->
                <x-form
                    method="PUT"
                    action="{{ route('products.update', $product) }}"
                    has-files
                    class="mt-4"
                >
                    <!-- Include form inputs for the product -->
                    @include('app.products.form-inputs')

                    <div class="mt-10">
                        <!-- Button to go back to the products index page -->
                        <a href="{{ route('products.index') }}" class="button">
                            <i
                                class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "
                            ></i>
                            @lang('crud.common.back')
                        </a>

                        <!-- Button to go to the create product page -->
                        <a href="{{ route('products.create') }}" class="button">
                            <i class="mr-1 icon ion-md-add text-primary"></i>
                            @lang('crud.common.create')
                        </a>

                        <!-- Button to submit the form and update the product -->
                        <button
                            type="submit"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
