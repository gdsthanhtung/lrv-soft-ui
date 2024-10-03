<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RoleUserModel extends Model
{
    use HasFactory;
    protected $table = 'role_users';

    public static function processAddRole($userId, $roles, $author = 0){
        $author = ($author) ? $author : Auth::id();
        Self::deleteRole($userId);
        return Self::addRole($userId, $roles, $author);
    }

    public static function deleteRole($userId){
        return Self::where('user_id', $userId)->delete();
    }

    public static function addRole($userId, $roles, $author = 0){
        $author = ($author) ? $author : Auth::id();
        $data = [];
        foreach($roles as $role){
            $data[] = [
                'user_id' => $userId,
                'role_id' => $role,
                'created_by' => $author,
                'updated_by' => $author,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        return Self::insert($data);
    }
}
