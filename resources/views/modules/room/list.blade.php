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
                <x-list.sortable-header field="created_at" label="Created At" />
                <th>Created By</th>
                <th>Updated By</th>
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

                        $avatar     = Template::showItemAvatar($ctrl, $item['avatar'], $item['name']);
                        $status     = Template::showItemStatus($ctrl, $id, $item['status'], false);
                        $createdHis = Template::showItemHistory($item->createdBy->name, $item->createdBy->name, 'add');
                        $updatedHis = Template::showItemHistory($item->updatedBy->name, $item->updatedBy->name, 'edit');

                    @endphp

                    <td>{{ $loop->iteration }}</td>
                    <td>{!! $name !!}</td>
                    <td class="max-width-300">{!! $note !!}</td>
                    <td>{!! $status !!}</td>
                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
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
