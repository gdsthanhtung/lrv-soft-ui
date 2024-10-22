@props(['params', 'searchSelection', 'ctrl'])

@php
    $selections = '';
    list($searchField, $searchValue) = $params;

    $rule = Config::get('gds.enum.' . $searchSelection);
    $selectionInModule = Config::get('gds.enum.selectionInModule');
    $ctrl = isset($selectionInModule[$ctrl]) ? $ctrl : 'default';
    $clearFilterLink = route($routePrefix . 'clear');

    foreach($selectionInModule[$ctrl] as $item){
        $selected = ($searchField == $item) ? 'selected' : '';
        $selections .= sprintf("<option class='select-field' value='%s' %s>%s</option>",  $item, $selected, $rule[$item]['name']);
    }
@endphp

<div class="dataTable-search">
    <div class="row">
        <div class="col-sm pe-0 pb-2">
            <select class="form-select dataTable-input filter-search custom-select-padding" id="search-field" name="search_field" data-bs-toggle="tooltip" data-bs-original-title="Search by">
                {!! $selections !!}
            </select>
        </div>
        <div class="col-sm ps-2">
            <div class="input-group">
                <input type="text" class="form-control dataTable-input" placeholder="Search..." id="search-value" name="search_value" value="{{ $searchValue }}" data-bs-toggle="tooltip" data-bs-original-title="Enter your keyword">
                <span class="input-group-text clear-search" id="btn-search" data-bs-toggle="tooltip" data-bs-original-title="Search" onclick="$('#filter-form').submit();"><i class="fa-solid fa-magnifying-glass"></i></span>
                <span class="input-group-text clear-search" id="btn-clear" data-bs-toggle="tooltip" data-bs-original-title="Clear" style="border-right: 1px solid #e9ecef;" onclick="window.location='{{ $clearFilterLink }}'"><i class="fa-regular fa-circle-xmark"></i></span>
            </div>
        </div>
    </div>
    <input type="hidden" name="page" value="{{ session($ctrl . '.page', 1) }}">
</div>
