@php
    $tmplDisplay = Config::get('gds.enum.select' . ucfirst($fieldName));
    $html = sprintf('<select id="%s" name="%s" class="form-select selectChangeAttr"><option>Select an item...</option>', $fieldName, $fieldName);

    foreach ($tmplDisplay as $key => $value) {
        $htmlSelected = '';
        if ($key == $displayValue) $htmlSelected = 'selected';
        $html .= sprintf('<option value="%s" %s>%s</option>', $key, $htmlSelected, $value);
    }
    $html .= '</select>';
@endphp
{!! $html !!}
