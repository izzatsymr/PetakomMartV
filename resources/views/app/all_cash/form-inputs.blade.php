@php $editing = isset($cash) @endphp

@php $editing = isset($cash) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $cash->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>


    <x-inputs.group class="w-full">
        <x-inputs.number id="opening_cash" name="opening_cash" label="Opening Cash" max="255" step="0.01" placeholder="Opening Cash" required onchange="calculateShortCash()"></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number id="closing_cash" name="closing_cash" label="Closing Cash" max="255" step="0.01" placeholder="Closing Cash" onchange="calculateShortCash()"></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number id="short_cash" name="short_cash" label="Short Cash" max="255" step="0.01" placeholder="Short Cash" required></x-inputs.number>
    </x-inputs.group>
</div>

<script>
    function calculateShortCash() {
        var openingCash = parseFloat(document.getElementById('opening_cash').value);
        var closingCash = parseFloat(document.getElementById('closing_cash').value);

        // If closingCash is NaN or not provided, set it to 0
        if (isNaN(closingCash)) {
            closingCash = 0;
        }

        var shortCash = closingCash - openingCash;
        document.getElementById('short_cash').value = shortCash.toFixed(2);
    }
</script>