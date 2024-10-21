<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\Notify;
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
            'id', // Default sort by
            'desc', // Default sort order
        );

        // Apply date filters
        $this->applyDateFilters($request, $query, $this->sessionKey, 'created_at');

        $data = $query->with(['createdBy', 'updatedBy'])->paginate($perPage, ['*'], 'page', $page);

        return view($this->pathView.'index', compact('data'));
    }

    public function create()
    {
        return view($this->pathView.'form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:255|unique:{$this->table},name",
            'note' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $rs = MainModel::create([
            'name' => $request->name,
            'note' => $request->note,
            'status' => $request->status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    public function edit($id)
    {
        $data = MainModel::findOrFail($id);
        return view($this->pathView.'form', compact('data'));
    }

    public function update(Request $request, MainModel $room)
    {
        $data = $room;
        $request->validate([
            'name' => "required|string|max:255|unique:{$this->table},name,{$data->id}",
            'note' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $rs = $data->update([
            'name' => $request->name,
            'note' => $request->note,
            'status' => $request->status,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    public function destroy(MainModel $room)
    {
        $data = $room;
        $rs = $data->delete();
        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }
}
