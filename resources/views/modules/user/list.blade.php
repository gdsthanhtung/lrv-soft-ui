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
                <th>Info</th>
                <th>Level</th>
                <th class="text-center">Status</th>
                <th>History</th>
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
                                $email      = Highlight::show($item['email'], $params['filter'], 'email');

                                $avatar     = Template::showItemAvatar($ctrl, $item['avatar'], $item['name']);
                                $status     = Template::showItemStatus($ctrl, $id, $item['status']);
                                $level      = Template::showItemDropdown($ctrl, $id, $item['level'], 'level');
                                $createdHis = Template::showItemHistory($item['created_by_name'], $item['created_at'], 'add');
                                $updatedHis = Template::showItemHistory($item['updated_by_name'], $item['updated_at'], 'edit');
                                $actionBtn  = Template::showActionButton($ctrl, $id);
                            @endphp

                            <td class="text-sm">{{ $no }}</td>
                            <td class="text-sm">{!! $avatar !!}</td>
                            <td width="20%" class="text-sm">
                                <span class="text-sm mb-0 text-capitalize font-weight-bold">Name: </span> {!! $name !!}<br>
                                <span class="text-sm mb-0 text-capitalize font-weight-bold">Email: </span> {!! $email !!}
                            </td>
                            <td class="text-sm">{!! $level !!}</td>
                            <td class="text-sm text-center">{!! $status !!}</td>
                            <td class="text-sm">{!! $createdHis !!} <hr class='horizontal dark m-1'> {!! $updatedHis !!}</td>
                            <td class="text-sm text-center">{!! $actionBtn !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('templates.list_empty', ['colspan' => 100])
                @endif
    </table>
</div>
