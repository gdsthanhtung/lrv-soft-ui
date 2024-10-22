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

    protected $fillable = ['name', 'email', 'password', 'email', 'phone', 'avatar', 'status', 'created_by', 'updated_by'];

    /* RELATIONSHIP */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function roles(){
        return $this->belongsToMany(RoleModel::class, 'role_users', 'user_id', 'role_id');
    }

    /* FUNCTIONS */
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
