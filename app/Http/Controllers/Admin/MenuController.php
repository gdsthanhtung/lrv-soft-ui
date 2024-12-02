<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\Notify;
use App\Http\Controllers\AdminBaseController;
use App\Models\Menu as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ModuleControllerHelper;
use Spatie\Permission\Models\Permission;

class MenuController extends AdminBaseController
{
    use ModuleControllerHelper;

    /**
     * Constructor to apply middleware.
     */
    public function __construct()
    {
        $this->middleware('check.permissions:menus');
        $this->initializeModuleController('menu', 'Menu');
    }

    /**
     * Display a listing of the menus.
     */
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

    /**
     * Show the form for creating a new menu.
     */
    public function create()
    {
        $permissions = Permission::where('name', 'like', '%view%')->get();
        $parentMenus = MainModel::whereNull('parent_id')->orderBy('order')->get();
        return view($this->pathView.'form', compact('permissions', 'parentMenus'));
    }

    /**
     * Store a newly created menu in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255|unique:menus,name',
            'url'        => 'nullable|string|max:255',
            'icon'       => 'nullable|string|max:255',
            'order'      => 'required|integer',
            'permission' => 'nullable|string|max:255|exists:permissions,name',
            'status'     => 'required|in:active,inactive',
            'parent_id'  => 'nullable|exists:menus,id',
        ]);

        $rs = MainModel::create([
            'name'       => $request->name,
            'url'        => $request->url,
            'icon'       => $request->icon,
            'order'      => $request->order,
            'permission' => $request->permission,
            'status'     => $request->status,
            'parent_id'  => $request->parent_id,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    /**
     * Show the form for editing the specified menu.
     */
    public function edit($id)
    {
        $data = MainModel::findOrFail($id);
        $permissions = Permission::where('name', 'like', '%view%')->get();
        $parentMenus = MainModel::whereNull('parent_id')
                       ->where('id', '!=', $id)
                       ->orderBy('order')
                       ->get();
        return view($this->pathView.'form', compact('data', 'permissions', 'parentMenus'));
    }

    /**
     * Update the specified menu in storage.
     */
    public function update(Request $request, MainModel $menu)
    {
        $request->validate([
            'name'       => 'required|string|max:255|unique:menus,name,' . $menu->id,
            'url'        => 'nullable|string|max:255',
            'icon'       => 'nullable|string|max:255',
            'order'      => 'required|integer',
            'permission' => 'nullable|string|max:255|exists:permissions,name',
            'status'     => 'required|in:active,inactive',
            'parent_id'  => 'nullable|exists:menus,id|not_in:'.$menu->id, // Prevent setting itself as parent
        ]);

        $rs = $menu->update([
            'name'       => $request->name,
            'url'        => $request->url,
            'icon'       => $request->icon,
            'order'      => $request->order,
            'permission' => $request->permission,
            'status'     => $request->status,
            'parent_id'  => $request->parent_id,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    /**
     * Remove the specified menu from storage.
     */
    public function destroy(MainModel $menu)
    {
        $rs = $menu->delete();
        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }
}
