@php
    $html = '';
    if($listToSelect && is_array($listToSelect)) foreach ($listToSelect as $value => $title) {
        $checked = ($value === $valToChecked) ? 'checked' : '';
        $html .= "<div class='form-check form-check-inline'>
                    <input class='form-check-input' type='radio' name='$elName' id='$elName$value' value='$value' $checked>
                    <label class='form-check-label' for='$elName$value'>$title</label>
                </div>";
    }
@endphp
{!! $html !!}
