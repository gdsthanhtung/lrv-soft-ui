@php
    $totalItems = $data->total();
    $totalPages = $data->lastPage();
    $perPage = ($data->perPage() < $totalItems) ? $totalItems : $data->perPage();
@endphp

@if (count($data) > 0)
    <div class="dataTable-bottom">
        <div class="dataTable-info">Showing {{ $perPage }} of {{ $totalItems }} entries in {{ $totalPages }} pages</div>
        {{ $data->appends(request()->input())->links('templates.paginator_backend', ['paginator' => $data]) }}
    </div>
@endif
