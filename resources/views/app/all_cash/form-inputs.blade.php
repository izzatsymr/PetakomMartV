@php $editing = isset($cash) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $cash->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="opening_cash"
            label="Opening Cash"
            :value="old('opening_cash', ($editing ? $cash->opening_cash : ''))"
            max="255"
            step="0.01"
            placeholder="Opening Cash"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="closing_cash"
            label="Closing Cash"
            :value="old('closing_cash', ($editing ? $cash->closing_cash : ''))"
            max="255"
            step="0.01"
            placeholder="Closing Cash"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="short_cash"
            label="Short Cash"
            :value="old('short_cash', ($editing ? $cash->short_cash : ''))"
            max="255"
            step="0.01"
            placeholder="Short Cash"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
