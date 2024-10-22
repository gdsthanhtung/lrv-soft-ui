<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\Notify;
use App\Helpers\Resource;
use App\Http\Controllers\AdminBaseController;
use App\Models\RoleModel;
use App\Models\UserModel as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ModuleControllerHelper;

class UserController extends AdminBaseController
{
    use ModuleControllerHelper;

    public function __construct()
    {
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

        $data = $query->with(['createdBy', 'updatedBy','roles'])->paginate($perPage, ['*'], 'page', $page);

        return view($this->pathView.'index', compact('data'));
    }

    public function create()
    {
        return view($this->pathView.'form');
    }

    public function store(Request $request)
    {
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

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    public function edit($id)
    {
        $data = MainModel::with(['roles'])->findOrFail($id);
        $uRole = $data->roles->pluck('id')->toArray();
        $dataRole = RoleModel::all()->pluck('name','id')->toArray();
        return view($this->pathView.'form', compact('data', 'dataRole', 'uRole'));
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
            $rs = $user->roles()->sync($request->roles);
        }

        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }

    public function destroy(MainModel $user)
    {
        $user->roles()->detach();
        $rs = $user->delete();
        return redirect()->route($this->routePrefix.'index')->with('notify', Notify::export($rs));
    }
}
