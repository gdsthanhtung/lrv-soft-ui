@php
    use App\Helpers\Template;
    use App\Helpers\Highlight;
@endphp

<div class="dataTable-container">
    <table class="table table-flush dataTable-table" id="products-list">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <x-list.sortable-header field="name" label="Name" />
                <th>Permissions</th>
                <th class="text-center action-button-col">Action</th>
            </tr>
        </thead>


        @if (count($data) > 0)
            @foreach($data as $item)
                <tr>
                    @php
                        $id         = $item['id'];
                        $name       = Highlight::show($ctrl, $item['name'], 'name');
                        $pms        = ($item['permissions']) ? $item['permissions'] : [];
                    @endphp

                    <td>{{ $loop->iteration }}</td>
                    <td>{!! $name !!}</td>
                    <td>
                        @for ($i = 0; $i < count($pms); $i++)
                            <span class="badge bg-secondary">{{ $pms[$i]['name'] }}</span>
                            {!! (($i + 1) % 8 == 0) ? '<br><div class="mb-1"></div>' : '' !!}
                        @endfor
                    </td>
                    <td class="text-sm text-center"><x-button.action :ctrl="$ctrl" :id="$id" /></td>
                </tr>
            @endforeach
        @else
            @include('templates.list_empty', ['colspan' => 100])
        @endif
    </table>
</div>
