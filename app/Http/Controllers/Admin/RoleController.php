<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Notify;
use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use App\Traits\ModuleControllerHelper;
use Spatie\Permission\Models\Role as MainModel;
use Spatie\Permission\Models\Permission;

class RoleController extends AdminBaseController
{
    use ModuleControllerHelper;

    public function __construct()
    {
        $this->middleware('check.permissions:roles');
        $this->initializeModuleController('role', 'Role');
    }

    //=====================================================

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
        $permissions = Permission::all();
        return view($this->pathView.'form', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:255|unique:{$this->table},name",
            'permissions' => 'array',
        ]);

        $rs = MainModel::create([
            'name' => $request->name,
        ]);

        if ($rs && $request->permissions) {
            $rs = $rs->syncPermissions($request->permissions);
        }

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    public function edit($id)
    {
        $data = MainModel::findOrFail($id);
        $permissions = Permission::all();
        return view($this->pathView.'form', compact('data', 'permissions'));
    }

    public function update(Request $request, MainModel $role)
    {
        $request->validate([
            'name' => "required|string|max:255|unique:{$this->table},name,{$role->id}",
            'permissions' => 'array',
        ]);

        $data = MainModel::findOrFail($role->id);
        $data->name = $request->name;
        $rs = $data->save();

        if ($rs && $request->permissions) {
            $rs = $data->syncPermissions($request->permissions);
        }

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    public function destroy($id)
    {
        $data = MainModel::findOrFail($id);
        $rs = $data->delete();
        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }
}
