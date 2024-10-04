<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Resource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $uploadDir = 'user';

    protected $crudNotAccepted = ['_token', 'avatar', 'current_avatar', 'password_confirmation', 'task'];

    /* RELATIONSHIP */
    public function roles(){
        return $this->belongsToMany(RoleModel::class, 'role_users', 'user_id', 'role_id');
    }

    /* FUNCTIONS */
    public function listItems($params = null, $options = null){
        $this->table = $this->table.' as main';
        $result = null;
        extract($params);

        if($options['task'] == 'admin-list-items'){
            $query = Self::select(DB::raw('main.*, c_user.name as created_by_name, u_user.name as updated_by_name'));
            if($searchValue)
                if($searchField == 'all'){
                    $query->where(function($query) use ($searchFieldAccepted, $searchValue){
                        foreach($searchFieldAccepted as $field){
                            if($field != 'all') $query->orWhere('main.'.$field, 'LIKE', "%$searchValue%");
                        }
                    });
                }else{
                    $query->where('main.'.$searchField, 'LIKE', "%$searchValue%");
                }

            if($status != 'all'){
                $query->where('main.status', $status);
            }
            $query->leftJoin('users as c_user', 'c_user.id', '=', 'main.created_by');
            $query->leftJoin('users as u_user', 'u_user.id', '=', 'main.updated_by');
            $result = $query->orderBy($sortBy, $sortOrder)->paginate($perPage, $columns = ['*'], $pageName = 'page', $page);
        }

        return $result;
    }

    public function delete($params = null){
        $result = null;
        $item = Self::getItem($params, ['task' => 'get-item']);
        $result = Self::where('id', $params['id'])->delete();

        if($result) Resource::delete($this->uploadDir, $item['avatar']);
        return $result;
    }

    public function saveItem($params = null, $options = null){
        $result = null;
        $id = (isset($params['id'])) ? $params['id'] : null;
        $params['updated_at'] = Carbon::now();

        if($options['task'] == 'change-status'){
            $paramsNew = $params;
            $paramsNew['status'] = ($params['status'] == 'active') ? 'inactive' : 'active';
            $paramsNew['updated_by'] = Auth::id();
            $result = Self::where('id', $id)->update($paramsNew);
        }

        if($options['task'] == 'change-level'){
            $paramsNew = $params;
            $paramsNew['updated_by'] = Auth::id();
            $result = Self::where('id', $id)->update($paramsNew);
        }

        if($options['task'] == 'update-role'){
            //Prepair data
            $userId = $params['id'];
            $roles = $params['roles'];

            //Remove all old user's roles
            $roleUserModel = new RoleUserModel();
            $result = $roleUserModel::processAddRole($userId, $roles);
        }

        if($options['task'] == 'add'){
            $paramsNew = array_diff_key($params, array_flip($this->crudNotAccepted));
            $paramsNew['created_at']       = Carbon::now();
            $paramsNew['created_by']    = $paramsNew['updated_by'] = Auth::id();
            $paramsNew['password']      = md5($params['password']);

            if(isset($params['avatar']) && $params['avatar']){
                $uploadRS = Resource::uploadImage($this->uploadDir, $params['avatar'], 'avatar');
                if($uploadRS)
                    $paramsNew['avatar'] = $uploadRS;
                else
                    return "Upload error..";
            }

            $result = Self::insert($paramsNew);
        }

        if($options['task'] == 'edit'){
            $paramsNew = array_diff_key($params, array_flip($this->crudNotAccepted));
            $paramsNew['updated_by'] = Auth::id();

            if(isset($params['avatar']) && $params['avatar']){
                $uploadRS = Resource::uploadImage($this->uploadDir, $params['avatar'], 'avatar');
                if($uploadRS){
                    Resource::delete($this->uploadDir, $params['current_avatar']);
                    $paramsNew['avatar'] = $uploadRS;
                }else
                    return "Upload error..";
            }

            $result = Self::where('id', $id)->update($paramsNew);
        }

        if($options['task'] == 'change-password'){
            $params['password']       = md5($params['password']);
            $result = Self::where('id', $id)->update(['password' => $params['password']]);
        }

        return $result;
    }

    public function getItem($params = null, $options = null){
        $result = null;
        if($options['task'] == 'get-item'){
            $result = Self::select('*')->where('id', $params['id'])->first();
        }

        if($options['task'] == 'do-login'){
            $result = Self::select(['id', 'username', 'name', 'email', 'status', 'level', 'avatar'])
                        ->firstWhere(['email' => $params['email'], 'password' => md5($params['password']), 'status' => 'active']);
            $result = ($result) ? $result->toArray() : null;
        }
        return $result;
    }

    public function getRoleUsers($userIds = []){
        $result = [];
        if($userIds){
            foreach($userIds as $userId){
                $dataForSelect = [];
                $dataForShow = [];
                $roles = Self::select('*')->where('id', $userId)->first()->roles;
                if($roles){
                    foreach ($roles as $key => $role) {
                        $dataForShow[$role->id] = $role->name;
                        $dataForSelect[] = $role->id;
                    }
                }
                $result[$userId] = ['dataForSelect' => $dataForSelect, 'dataForShow' => $dataForShow];
            }

        }
        return $result;
    }
}
