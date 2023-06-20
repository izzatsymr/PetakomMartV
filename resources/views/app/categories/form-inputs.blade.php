@php
    // Check if the category is being edited
    $editing = isset($category)
@endphp

<div class="flex flex-wrap">
    <!-- Grouping the input field within a form group -->
    <x-inputs.group class="w-full">
        <!-- Creating a text input field -->
        <x-inputs.text
            name="name" 
            label="Name" 
            :value="old('name', ($editing ? $category->name : ''))" 
            maxlength="255" 
            placeholder="Name" 
            required 
        ></x-inputs.text>
    </x-inputs.group>
</div>
