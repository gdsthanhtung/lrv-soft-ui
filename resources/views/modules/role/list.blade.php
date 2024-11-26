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
                    @endphp

                    <td>{{ $loop->iteration }}</td>
                    <td>{!! $name !!}</td>
                    <td width="40%">
                        @foreach($item['permissions'] as $permission)
                            <span class="badge bg-secondary">{{ $permission['name'] }}</span>
                        @endforeach
                    </td>
                    <td class="text-sm text-center"><x-button.action :ctrl="$ctrl" :id="$id" /></td>
                </tr>
            @endforeach
        @else
            @include('templates.list_empty', ['colspan' => 100])
        @endif
    </table>
</div>
