@php $editing = isset($inventory) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="product_id" label="Product" required>
            @php $selected = old('product_id', ($editing ? $inventory->product_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Product</option>
            @foreach($products as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="stock_quantity"
            label="Stock Quantity"
            :value="old('stock_quantity', ($editing ? $inventory->stock_quantity : ''))"
            max="255"
            placeholder="Stock Quantity"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
