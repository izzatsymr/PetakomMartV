@php $editing = isset($sale) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $sale->user_id : auth()->user()->id)); @endphp
            <option value="{{ $selected }}" selected>{{ auth()->user()->name }}</option>

        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="payment_method_id" label="Payment Method" required>
            @php $selected = old('payment_method_id', ($editing ? $sale->payment_method_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Method</option>
            @foreach($paymentMethods as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="product_id" label="Product" required>
            @php $selected = old('product_id', ($editing ? $sale->product_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Product</option>
            @foreach($products as $product_id => $name)
            <option value="{{ $product_id }}" {{ $selected == $product_id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>


    <x-inputs.group class="w-full">
        <x-inputs.number id="quantity" name="quantity" label="Quantity" :value="old('quantity', ($editing ? $sale->quantity : ''))" max="255" step="0.01" placeholder="Quantity" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number id="total_price" name="total_price" label="Total Price" :value="old('total_price', ($editing ? $sale->total_price : ''))" max="255" step="0.01" placeholder="Total Price" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number id="subtotal_sales" name="subtotal_sales" label="Subtotal Sales" :value="old('subtotal_sales', ($editing ? $sale->subtotal_sales : ''))" max="255" step="0.01" placeholder="Subtotal Sales" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number id="service_tax" name="service_tax" label="Service Tax" :value="old('service_tax', ($editing ? $sale->service_tax : ''))" max="255" step="0.01" placeholder="Service Tax" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number id="total_sales" name="total_sales" label="Total Sales" :value="old('total_sales', ($editing ? $sale->total_sales : ''))" max="255" step="0.01" placeholder="Total Sales" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $sale->status : '')) @endphp
            <option value="completed" {{ $selected == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="refunded" {{ $selected == 'refunded' ? 'selected' : '' }}>Refunded</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="refunded_reason" label="Refunded Reason" maxlength="255">{{ old('refunded_reason', ($editing ? $sale->refunded_reason : ''))
            }}</x-inputs.textarea>
    </x-inputs.group>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const subtotalSalesInput = document.getElementById('subtotal_sales');
        const serviceTaxInput = document.getElementById('service_tax');
        const totalSalesInput = document.getElementById('total_sales');

        subtotalSalesInput.addEventListener('input', function() {
            const subtotalSales = parseFloat(subtotalSalesInput.value);
            if (!isNaN(subtotalSales)) {
                const serviceTax = (subtotalSales * 0.06).toFixed(2);
                const totalSales = (subtotalSales + parseFloat(serviceTax)).toFixed(2);

                serviceTaxInput.value = serviceTax;
                totalSalesInput.value = totalSales;
            }
        });
    });
</script>