<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'location',
        'about_me',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasPermission($route) {
        $pms = $this->routes();
        return (in_array($route, $pms)) ? true : false;
    }

    public function routes() {
        $data = [];
        foreach ($this->getRoleList as $key => $role) {
            $permission = json_decode($role->permission);
            $data = array_merge($data, $permission);
        }
        $data = array_unique($data);
        return $data;
    }

    public function getRoleList(){
        return $this->belongsToMany(RoleModel::class, 'user_roles', 'user_id', 'role_id');
    }
}
