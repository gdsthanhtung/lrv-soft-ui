<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\Notify;
use App\Helpers\Resource;
use App\Http\Controllers\AdminBaseController;
use App\Models\User as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ModuleControllerHelper;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends AdminBaseController
{
    use ModuleControllerHelper;

    public function __construct()
    {
        $this->middleware('check.permissions:users');

        $this->initializeModuleController('user', 'User');
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

        $data = $query->with(['createdBy', 'updatedBy', 'roles', 'permissions'])->paginate($perPage, ['*'], 'page', $page);

        return view($this->pathView.'index', compact('data'));
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view($this->pathView.'form', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        //dd($request->roles, $request->permissions );
        $avatar = null;
        if ($request->hasFile('avatar')) {
            $avatar = Resource::uploadImage($this->ctrl, $request->file('avatar'), 'avatar');
            if(!$avatar)
                return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export(false, 'Upload avatar failed!'));
        }

        $rs = MainModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => $avatar ?? '',
            'status' => $request->status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        $rs->syncRoles($request->roles);
        $rs->syncPermissions($request->permissions);

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    public function edit($id)
    {
        $data = MainModel::findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view($this->pathView.'form', compact('data', 'roles', 'permissions'));
    }

    public function update(Request $request, MainModel $user)
    {
        $task = $request->task ?? '';
        $rs = false;

        if($task == 'update-info'){
            if ($request->hasFile('avatar')) {
                $avatar = Resource::uploadImage($this->ctrl, $request->file('avatar'), 'avatar');
                if($avatar)
                    Resource::delete($this->ctrl, $request->current_avatar);
                else
                    return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export(false, 'Upload avatar failed!'));
            }

            $rs = $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'avatar' => $avatar ?? $request->current_avatar,
                'status' => $request->status,
                'updated_by' => Auth::id(),
            ]);
        }

        if($task == 'change-password'){
            $rs = $user->update([
                'password' => bcrypt($request->password),
                'updated_by' => Auth::id(),
            ]);
        }

        if($task == 'assign-role'){
            $rsRoles = $user->syncRoles($request->roles);
            $rsPermissions = $user->syncPermissions($request->permissions);
            if($rsRoles && $rsPermissions) $rs = true;
        }

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    public function destroy(MainModel $user)
    {
        $rs = $user->delete();
        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }
}
