<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoleModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest as MainRequest;
use App\Helpers\Notify;
use App\Http\Controllers\AdminBaseController;
use App\Traits\ModuleControllerHelper;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class RoleController extends AdminBaseController
{
    use ModuleControllerHelper;

    public function __construct()
    {
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
        $routeList = $this->getRouteList();
        return view($this->pathView.'form', compact('routeList'));
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
            'permission' => json_encode($request->permission),
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    public function edit($id)
    {
        $data = MainModel::findOrFail($id);
        $routeList = $this->getRouteList();
        return view($this->pathView.'form', compact('data', 'routeList'));
    }

    public function update(Request $request, MainModel $role)
    {
        $data = $role;
        $request->validate([
            'name' => "required|string|max:255|unique:{$this->table},name,{$data->id}",
            'note' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $rs = $data->update([
            'name' => $request->name,
            'note' => $request->note,
            'status' => $request->status,
            'permission' => json_encode($request->permission),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    public function destroy(MainModel $role)
    {
        $data = $role;
        $rs = $data->delete();
        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    //=====================================================

    public function getRouteList(){
        $routes = [];
        $fullRoutes = Route::getRoutes();
        foreach ($fullRoutes as $key => $value) {
            if(strpos($value->getName(), 'admin.') !== false)
                $routes[$value->getName()] = $value->getName();
        }
        return $routes;
    }
}
