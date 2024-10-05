<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Models\RoomModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends AdminBaseController
{
    protected $sessionKey = 'room.';

    public function index(Request $request)
    {
        list($query, $perPage, $page) = $this->handleFilters(
            RoomModel::class,
            $request,
            $this->sessionKey, // Session key prefix
            ['name', 'note'], // Search fields like %%
            ['status'], // Filter fields equals
            'name', // Default sort by
            'asc', // Default sort order
        );

        $rooms = $query->with(['createdBy', 'updatedBy'])->paginate($perPage, ['*'], 'page', $page);

        return view('modules.room.index', compact('rooms'));
    }

    public function clear(Request $request)
    {
        // Clear the relevant session data
        $request->session()->forget(substr($this->sessionKey, 0, -1));

        // Redirect back to the index route
        return redirect()->route('admin.room.index');
    }

    public function create()
    {
        return view('modules.room.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name',
            'note' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        RoomModel::create([
            'name' => $request->name,
            'note' => $request->note,
            'status' => $request->status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.room.index')->with('success', 'Room created successfully.');
    }

    public function edit(RoomModel $room)
    {
        return view('modules.room.edit', compact('room'));
    }

    public function update(Request $request, RoomModel $room)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name,' . $room->id,
            'note' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $room->update([
            'name' => $request->name,
            'note' => $request->note,
            'status' => $request->status,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.room.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(RoomModel $room)
    {
        $room->delete();
        return redirect()->route('admin.room.index')->with('success', 'Room deleted successfully.');
    }
}
