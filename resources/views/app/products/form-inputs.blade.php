@php $editing = isset($product) @endphp

<div class="flex flex-wrap">
    <!-- Select input for category -->
    <x-inputs.group class="w-full">
        <x-inputs.select name="category_id" label="Category" required>
            @php $selected = old('category_id', ($editing ? $product->category_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Category</option>
            @foreach($categories as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <!-- Image input -->
    <x-inputs.group class="w-full">
        <div x-data="imageViewer('{{ $editing && $product->image ? \Storage::url($product->image) : '' }}')">
            <x-inputs.partials.label name="image" label="Image"></x-inputs.partials.label><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img :src="imageUrl" class="object-cover rounded border border-gray-200" style="width: 100px; height: 100px;" />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div class="border rounded border-gray-200 bg-gray-100" style="width: 100px; height: 100px;"></div>
            </template>

            <div class="mt-2">
                <input type="file" name="image" id="image" @change="fileChosen" />
            </div>

            @error('image')
                @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <!-- Text input for name -->
    <x-inputs.group class="w-full">
        <x-inputs.text name="name" label="Name" :value="old('name', ($editing ? $product->name : ''))" maxlength="255" placeholder="Name" required></x-inputs.text>
    </x-inputs.group>

    <!-- Textarea input for description -->
    <x-inputs.group class="w-full">
        <x-inputs.textarea name="description" label="Description" maxlength="255" required>{{ old('description', ($editing ? $product->description : '')) }}</x-inputs.textarea>
    </x-inputs.group>

    <!-- Number input for price -->
    <x-inputs.group class="w-full">
        <x-inputs.number name="price" label="Price" :value="old('price', ($editing ? $product->price : ''))" max="255" step="0.01" placeholder="Price" required></x-inputs.number>
    </x-inputs.group>
</div>
