<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Models\RoomModel as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ModuleControllerHelper;

class RoomController extends AdminBaseController
{
    use ModuleControllerHelper;

    public function __construct()
    {
        $this->initializeModuleController('room', 'Room');
    }

    public function index(Request $request)
    {
        list($query, $perPage, $page) = $this->handleFilters(
            MainModel::class,
            $request,
            $this->sessionKey, // Session key prefix
            $this->moduleName, // Search fields like %%
            ['status'], // Filter fields equals
            'name', // Default sort by
            'asc', // Default sort order
        );

        // Apply date filters
        $this->applyDateFilters($request, $query, $this->sessionKey, 'created_at');

        $data = $query->with(['createdBy', 'updatedBy'])->paginate($perPage, ['*'], 'page', $page);

        return view('modules.room.index', compact('data'));
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
        return view('modules.room.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name',
            'note' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        MainModel::create([
            'name' => $request->name,
            'note' => $request->note,
            'status' => $request->status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.room.index')->with('success', 'Room created successfully.');
    }

    public function edit(MainModel $data)
    {
        return view('modules.room.form', compact('data'));
    }

    public function update(Request $request, MainModel $room)
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

    public function destroy(MainModel $room)
    {
        $room->delete();
        return redirect()->route('admin.room.index')->with('success', 'Room deleted successfully.');
    }
}
