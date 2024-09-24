@php
    use App\Helpers\Template;
    use App\Helpers\Highlight;
@endphp

<div class="dataTable-container">
    <table class="table table-flush dataTable-table" id="products-list">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th class="text-center">Status</th>
                <th>Create History</th>
                <th>Update History</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        @if (count($data) > 0)
            @foreach ($data as $key => $item)
                <tr class="odd pointer">
                    @php
                        $no = ++$key;
                        $id = $item['id'];
                        $name       = Highlight::show($item['name'], $params['filter'], 'name');

                        $status     = Template::showItemStatus($ctrl, $id, $item['status']);
                        $createdHis = Template::showItemHistory($item['created_by_name'], $item['created_at'], 'add');
                        $updatedHis = Template::showItemHistory($item['updated_by_name'], $item['updated_at'], 'edit');
                    @endphp

                    <td class="text-sm">{{ $no }}</td>
                    <td width="20%" class="text-sm">{!! $name !!}</td>
                    <td class="text-sm text-center">{!! $status !!}</td>
                    <td class="text-sm">{!! $createdHis !!} </td>
                    <td class="text-sm">{!! $updatedHis !!}</td>
                    <td class="text-sm text-center"><x-button.action :ctrl="$ctrl" :id="$id" /></td>
                </tr>
            @endforeach
        @else
            @include('templates.list_empty', ['colspan' => 100])
        @endif
    </table>
</div>
