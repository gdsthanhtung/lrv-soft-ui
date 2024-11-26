@php
    use App\Helpers\Template;
    use App\Helpers\Highlight;
@endphp

<div class="dataTable-container">
    <table class="table table-flush dataTable-table" id="products-list">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Avatar</th>
                <x-list.sortable-header field="name" label="Name/Email" />
                <th>Roles</th>
                <th>Direct Permissions</th>
                <x-list.sortable-header field="status" label="Status" />
                <x-list.sortable-header field="created_at" label="Create/Update His" />
                <th class="text-center action-button-col">Action</th>
            </tr>
        </thead>

        @if (count($data) > 0)
            @foreach($data as $item)
                <tr>
                    @php
                        $id         = $item['id'];
                        $name       = Highlight::show($ctrl, $item['name'], 'name');
                        $email      = Highlight::show($ctrl, $item['email'], 'email');

                        $avatar     = Template::showItemAvatar($ctrl, $item['avatar'], $item['name']);

                        $status     = Template::showItemStatus($ctrl, $id, $item['status'], false);
                        $createdHis = Template::showItemHistory($item->createdBy->name, $item['updated_at'], 'add');
                        $updatedHis = Template::showItemHistory($item->updatedBy->name, $item['created_at'], 'edit');

                    @endphp

                    <td>{{ $loop->iteration }}</td>
                    <td>{!! $avatar !!}</td>
                    <td width="20%">
                        <span class="mb-0 text-capitalize font-weight-bold">Name: </span> {!! $name !!}<br>
                        <span class="mb-0 text-capitalize font-weight-bold">Email: </span> {!! $email !!}
                    </td>
                    <td>
                        @foreach ($item->roles as $role)
                            <span class="badge bg-info">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($item->permissions as $permission)
                            <span class="badge bg-secondary">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td>{!! $status !!}</td>
                    <td>{!! $createdHis !!} <hr class='horizontal dark m-1'> {!! $updatedHis !!}</td>
                    <td class="text-sm text-center"><x-button.action :ctrl="$ctrl" :id="$id" /></td>
                </tr>
            @endforeach
        @else
            @include('templates.list_empty', ['colspan' => 100])
        @endif
    </table>
</div>

