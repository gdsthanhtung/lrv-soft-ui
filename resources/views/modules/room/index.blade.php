<!-- resources/views/rooms/index.blade.php -->
@extends('elements.auth')

@section('content')
<form method="GET" action="{{ route('admin.room.index') }}">
    <input type="text" name="search" value="{{ session('search') }}" placeholder="Search by name or note">
    <select name="status">
        <option value="">All</option>
        <option value="active" {{ session('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ session('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
    <select name="per_page">
        <option value="10" {{ session('per_page') == 10 ? 'selected' : '' }}>10</option>
        <option value="25" {{ session('per_page') == 25 ? 'selected' : '' }}>25</option>
        <option value="50" {{ session('per_page') == 50 ? 'selected' : '' }}>50</option>
    </select>
    <input type="hidden" name="page" value="{{ session('page', 1) }}">
    <button type="submit">Filter</button>
</form>

<a href="{{ route('admin.room.create') }}">Create Room</a>

<table>
    <thead>
        <tr>
            <th><a href="{{ route('admin.room.index', array_merge(request()->all(), ['sort_by' => 'name', 'sort_order' => session('sort_order') == 'asc' ? 'desc' : 'asc'])) }}">Name</a></th>
            <th><a href="{{ route('admin.room.index', array_merge(request()->all(), ['sort_by' => 'note', 'sort_order' => session('sort_order') == 'asc' ? 'desc' : 'asc'])) }}">Note</a></th>
            <th><a href="{{ route('admin.room.index', array_merge(request()->all(), ['sort_by' => 'status', 'sort_order' => session('sort_order') == 'asc' ? 'desc' : 'asc'])) }}">Status</a></th>
            <th><a href="{{ route('admin.room.index', array_merge(request()->all(), ['sort_by' => 'created_by', 'sort_order' => session('sort_order') == 'asc' ? 'desc' : 'asc'])) }}">Created By</a></th>
            <th><a href="{{ route('admin.room.index', array_merge(request()->all(), ['sort_by' => 'updated_by', 'sort_order' => session('sort_order') == 'asc' ? 'desc' : 'asc'])) }}">Updated By</a></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rooms as $room)
        <tr>
            <td>{{ $room->name }}</td>
            <td>{{ $room->note }}</td>
            <td>{{ $room->status }}</td>
            <td>{{ $room->createdBy->name }}</td>
            <td>{{ $room->updatedBy->name }}</td>
            <td>
                <a href="{{ route('admin.room.edit', $room->id) }}">Edit</a>
                <form action="{{ route('admin.room.destroy', $room->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $rooms->appends(request()->query())->links() }}
@endsection
