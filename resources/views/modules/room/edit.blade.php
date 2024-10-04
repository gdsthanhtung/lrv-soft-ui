<!-- resources/views/rooms/edit.blade.php -->
@extends('elements.auth')

@section('content')
<form method="POST" action="{{ route('admin.room.update', $room->id) }}">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $room->name) }}" required>
        @error('name')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="note">Note</label>
        <textarea id="note" name="note">{{ old('note', $room->note) }}</textarea>
        @error('note')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="active" {{ old('status', $room->status) == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status', $room->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Update Room</button>
    <button type="button" onclick="window.history.back()" class="btn btn-secondary">Back</button>
</form>
@endsection
