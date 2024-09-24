@php
    $html = "";
    $selections = "";

    extract($params);
    $searchField = $filter['searchField'];
    $searchValue = $filter['searchValue'];

    $rule = Config::get('gds.enum.'.$searchSelection);
    $selectionInModule = Config::get('gds.enum.selectionInModule');
    $ctrl = (isset($selectionInModule[$ctrl]))  ? $ctrl : 'default';

    foreach($selectionInModule[$ctrl] as $item){
        $selected = ($searchField == $item) ? 'selected' : '';
        $selections .= sprintf("<option class='select-field' value='%s' %s>%s</option>",  $item, $selected, $rule[$item]['name']);
    }

    $html = sprintf('<div class="dataTable-search">
                        <div class="row">
                            <div class="col-sm pe-0">
                                <select class="form-select dataTable-input filter-search" id="search-field" name="searchField" data-bs-toggle="tooltip" data-bs-original-title="Filter">
                                    %s
                                </select>
                            </div>
                            <div class="col-sm">
                                <div class="input-group">
                                    <input type="text" class="form-control dataTable-input" placeholder="Search..." id="search-value" name="searchValue" value="%s" data-bs-toggle="tooltip" data-bs-original-title="Enter your keyword">
                                    <span class="input-group-text clear-search" id="btn-search" data-bs-toggle="tooltip" data-bs-original-title="Search"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <span class="input-group-text clear-search" id="btn-clear" data-bs-toggle="tooltip" data-bs-original-title="Clear" style="border-right: 1px solid #e9ecef;"><i class="fa-regular fa-circle-xmark" ></i></span>
                                </div>
                            </div>
                        </div>
                    </div>', $selections, $searchValue);
@endphp

{!! $html !!}
