@if (count($data) > 0)
    <div class="dataTable-bottom">
        @include($pathViewTemplate.'per_page')
        {{ $data->appends(request()->input())->links('templates.paginator_backend', ['paginator' => $data]) }}
    </div>
    <input type="hidden" value="{{ $data->currentPage() }}" id="page">
@endif
