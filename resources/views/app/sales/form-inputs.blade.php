@php $editing = isset($sale) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $sale->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="payment_method_id"
            label="Payment Method"
            required
        >
            @php $selected = old('payment_method_id', ($editing ? $sale->payment_method_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Method</option>
            @foreach($paymentMethods as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="subtotal_sales"
            label="Subtotal Sales"
            :value="old('subtotal_sales', ($editing ? $sale->subtotal_sales : ''))"
            max="255"
            step="0.01"
            placeholder="Subtotal Sales"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="service_tax"
            label="Service Tax"
            :value="old('service_tax', ($editing ? $sale->service_tax : ''))"
            max="255"
            step="0.01"
            placeholder="Service Tax"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="total_sales"
            label="Total Sales"
            :value="old('total_sales', ($editing ? $sale->total_sales : ''))"
            max="255"
            step="0.01"
            placeholder="Total Sales"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $sale->status : '')) @endphp
            <option value="completed" {{ $selected == 'completed' ? 'selected' : '' }} >Completed</option>
            <option value="refunded" {{ $selected == 'refunded' ? 'selected' : '' }} >Refunded</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="refunded_reason"
            label="Refunded Reason"
            maxlength="255"
            >{{ old('refunded_reason', ($editing ? $sale->refunded_reason : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
