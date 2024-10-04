<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\RoomModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve filters and sorting from session or use default values
        $search = $request->input('search', session('search', ''));
        $status = $request->input('status', session('status', ''));
        $perPage = $request->input('per_page', session('per_page', 10));
        $sortBy = $request->input('sort_by', session('sort_by', 'name'));
        $sortOrder = $request->input('sort_order', session('sort_order', 'asc'));
        $page = $request->input('page', session('page', 1));

        // Store filters, sorting, and page in session
        session([
            'search' => $search,
            'status' => $status,
            'per_page' => $perPage,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
            'page' => $page,
        ]);

        $query = RoomModel::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('note', 'like', '%' . $search . '%');
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $rooms = $query->orderBy($sortBy, $sortOrder)->paginate($perPage, ['*'], 'page', $page);

        return view('modules.room.index', compact('rooms'));
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
