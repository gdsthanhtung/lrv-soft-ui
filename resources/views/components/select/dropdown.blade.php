@props(['ctrl', 'id', 'fieldName', 'displayValue'])

@php
    $html = $list = '';
    $enum = Config::get('gds.enum.select' . ucfirst($fieldName));

    foreach ($enum['value'] as $key => $value) {
        $link = route('admin.'.$ctrl.'.change-' . $fieldName, [$fieldName => $key, 'id' => $id]);
        $list .= sprintf('<li><a class="dropdown-item" href="%s">%s</a></li>', $link, $value);
    }

    $class = isset($enum['class'][$displayValue]) ? $enum['class'][$displayValue] : 'secondary';
    $value = isset($enum['value'][$displayValue]) ? $enum['value'][$displayValue] : 'N/A';

    $html = sprintf('
        <div class="dropdown">
            <button class="btn bg-gradient-%s btn-sm dropdown-toggle mb-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                %s
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                %s
            </ul>
        </div>
    ', $class, $value, $list);
@endphp

{!! $html !!}
