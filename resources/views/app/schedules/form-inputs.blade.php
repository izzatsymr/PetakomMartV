@php $editing = isset($schedule) @endphp

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $schedule->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#timepicker", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i:S",
            time_24hr: true,
        });
    </script>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($schedule->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="start_time"
            label="Start Time"
            :value="old('start_time', ($editing ? $schedule->start_time : ''))"
            maxlength="255"
            placeholder="Start Time"
            required
            x-data
            x-init="flatpickr($refs.input, {
                enableTime: true,
                noCalendar: true,
                dateFormat: 'H:i:S',
                time_24hr: true,
            })"
            x-ref="input"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="end_time"
            label="End Time"
            :value="old('end_time', ($editing ? $schedule->end_time : ''))"
            maxlength="255"
            placeholder="End Time"
            required
            x-data
            x-init="flatpickr($refs.input, {
                enableTime: true,
                noCalendar: true,
                dateFormat: 'H:i:S',
                time_24hr: true,
            })"
            x-ref="input"
        ></x-inputs.text>
    </x-inputs.group>
</div>