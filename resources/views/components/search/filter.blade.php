@props(['ctrl', 'selected', 'ruleName', 'name'])

@php
    $options = Config::get('gds.enum.' . $ruleName);
@endphp

<select class="form-select dataTable-input filter-search custom-select-padding" id="{{ $name }}" name="{{ $name }}" data-bs-toggle="tooltip" data-bs-original-title="Filter {{ $name }}">
    <option value="">{{ 'Choose a' . (in_array(strtolower($name[0]), ['a', 'e', 'i', 'o', 'u']) ? 'n' : '') . ' ' . $name }}...</option>
    @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
