@php
    use App\Helpers\Template;
    use App\Helpers\Highlight;
@endphp

<div class="dataTable-container">
    <table class="table table-flush dataTable-table" id="products-list">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Icon</th>
                <x-list.sortable-header field="name" label="Name" />
                <x-list.sortable-header field="url" label="URL" />
                <th>Permission</th>
                <x-list.sortable-header field="order" label="Order" />
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
                        $icon       = $item['icon'] ? '<i class="' . $item['icon'] . '"></i>' : '';
                        $order      = $item['order'];
                        $name       = Highlight::show($ctrl, $item['name'], 'name');
                        $permission = Highlight::show($ctrl, $item['permission'], 'permission');
                        $url        = Highlight::show($ctrl, $item['url'], 'url');

                        $status     = Template::showItemStatus($ctrl, $id, $item['status'], false);
                        $createdHis = Template::showItemHistory($item->createdBy->name, $item['updated_at'], 'add');
                        $updatedHis = Template::showItemHistory($item->updatedBy->name, $item['created_at'], 'edit');
                    @endphp

                    <td>{{ $loop->iteration }}</td>
                    <td>{!! $icon !!}</td>
                    <td>{!! $name !!}</td>
                    <td>{!! $url !!}</td>
                    <td>{!! $permission !!}</td>
                    <td>{!! $order !!}</td>
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
