@php
    $html = '';
    if($listToSelect && is_array($listToSelect)) foreach ($listToSelect as $value => $title) {
        $checked = in_array($value, $valToChecked) ? 'checked' : '';
        $html .= "<div class='$col mb-2'><div class='form-check form-check-inline'>
                    <input class='form-check-input' type='checkbox' name='$elName"."[]"."' id='$elName$value' value='$value' $checked>
                    <label class='custom-control-label m-0 mt-1' for='$elName$value'>$title</label>
                </div></div>";
    }
    $html = sprintf('<div class="row">%s</div>', $html);
@endphp
{!! $html !!}
