@php
    // $totalItems = $data->total();
    // $totalPages = $data->lastPage();
    // $perPage = ($data->perPage() < $totalItems) ? $totalItems : $data->perPage();
@endphp

@if (count($data) > 0)
    <div class="dataTable-bottom">
        @include($pathViewTemplate.'per_page')
        {{ $data->appends(request()->input())->links('templates.paginator_backend', ['paginator' => $data]) }}
    </div>
@endif
