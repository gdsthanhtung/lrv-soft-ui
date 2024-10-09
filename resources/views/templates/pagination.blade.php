@if (count($data) > 0)
    <div class="dataTable-bottom">
        <div class="showing-results">
            <small>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results</small>
        </div>
        {{ $data->appends(request()->input())->links('templates.paginator_backend', ['paginator' => $data]) }}
    </div>
@endif
<input type="hidden" value="{{ $data->currentPage() }}" id="page">
