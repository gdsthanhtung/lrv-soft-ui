@php
    $ppEnum = Config::get('gds.perPage');
    $pp = (session('room.per_page')) ?? $ppEnum[0];
@endphp

<div class="dataTable-dropdown">
    <ul class="list-inline text-sm">
        <li class="list-inline-item">Show</li>
        <li class="list-inline-item">
            <select class="form-select dataTable-input filter-search" id="per-page">
                @foreach ($ppEnum as $item)
                    @php $selected = ($item == $pp) ? 'selected' : ''; @endphp
                    <option value="{{$item}}" {{$selected}}>{{$item}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                @endforeach
            </select>
        </li>
        <li class="list-inline-item">items/page</li>
      </ul>
</div>
<script>
    document.getElementById('per-page').addEventListener('change', function() {
        let perPage = this.value;
        let url = new URL(window.location.href);
        url.searchParams.set('per_page', perPage);
        window.location.href = url.toString();
    });
</script>
