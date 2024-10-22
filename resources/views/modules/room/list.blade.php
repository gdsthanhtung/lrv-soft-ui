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
                <x-list.sortable-header field="note" label="Note" />
                <x-list.sortable-header field="status" label="Status" />
                <x-list.sortable-header field="created_at" label="Create His" />
                <x-list.sortable-header field="updated_at" label="Update His" />
                <th class="text-center action-button-col">Action</th>
            </tr>
        </thead>

        @if (count($data) > 0)
            @foreach($data as $item)
                <tr>
                    @php
                        $id         = $item['id'];
                        $name       = Highlight::show($ctrl, $item['name'], 'name');
                        $note       = Highlight::show($ctrl, $item['note'], 'note');

                        $status     = Template::showItemStatus($ctrl, $id, $item['status'], false);
                        $createdHis = Template::showItemHistory($item->createdBy->name, $item['updated_at'], 'add');
                        $updatedHis = Template::showItemHistory($item->updatedBy->name, $item['created_at'], 'edit');
                    @endphp

                    <td>{{ $loop->iteration }}</td>
                    <td>{!! $name !!}</td>
                    <td class="max-width-300">{!! $note !!}</td>
                    <td>{!! $status !!}</td>
                    <td>{!! $createdHis !!}</td>
                    <td>{!! $updatedHis !!}</td>
                    <td class="text-sm text-center"><x-button.action :ctrl="$ctrl" :id="$id" /></td>
                </tr>
            @endforeach
        @else
            @include('templates.list_empty', ['colspan' => 100])
        @endif
    </table>
</div>
