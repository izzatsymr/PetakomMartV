<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.categories.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <!-- Displaying the "Back" button -->
                <x-slot name="title">
                    <a href="{{ route('categories.index') }}" class="mr-4">
                        <i class="mr-1 icon ion-md-arrow-back"></i>
                    </a>
                </x-slot>

                <!-- Form for editing the category -->
                <x-form method="PUT" action="{{ route('categories.update', $category) }}" class="mt-4">
                    <!-- Including the form inputs for the category -->
                    @include('app.categories.form-inputs')

                    <div class="mt-10">
                        <!-- "Back" button -->
                        <a href="{{ route('categories.index') }}" class="button">
                            <i class="mr-1 icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>

                        <!-- "Create" button -->
                        <a href="{{ route('categories.create') }}" class="button">
                            <i class="mr-1 icon ion-md-add text-primary"></i>
                            @lang('crud.common.create')
                        </a>

                        <!-- "Update" button -->
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
