<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\Notify;
use App\Http\Controllers\AdminBaseController;
use App\Models\Permission as MainModel;
use Illuminate\Http\Request;
use App\Traits\ModuleControllerHelper;
use Illuminate\Support\Str;

class PermissionController extends AdminBaseController
{
    use ModuleControllerHelper;

    public function __construct()
    {
        $this->middleware('check.permissions:permissions');
        $this->initializeModuleController('permission', 'Permission');
    }

    public function index(Request $request)
    {
        list($query, $perPage, $page) = $this->handleFilters(
            MainModel::class,
            $request,
            $this->sessionKey, // Session key prefix
            $this->moduleName, // Search fields like %%
            [], // Filter fields equals
            'id', // Default sort by
            'desc', // Default sort order
        );

        // Apply date filters
        $this->applyDateFilters($request, $query, $this->sessionKey, 'created_at');

        $data = $query->paginate($perPage, ['*'], 'page', $page);

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
        ]);

        $rs = MainModel::create([
            'name' => Str::lower($request->name),
            'note' => $request->note,
        ]);

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    public function edit($id)
    {
        $data = MainModel::findOrFail($id);
        return view($this->pathView.'form', compact('data'));
    }

    public function update(Request $request, MainModel $permission)
    {
        $data = $permission;
        $request->validate([
            'name' => "required|string|max:255|unique:{$this->table},name,{$data->id}",
            'note' => 'nullable|string',
        ]);

        $rs = $data->update([
            'name' => Str::lower($request->name),
            'note' => $request->note,
        ]);

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    public function destroy(MainModel $permission)
    {
        $rs = $permission->delete();
        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }
}
