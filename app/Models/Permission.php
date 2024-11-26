<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'permissions';

    // The attributes that are mass assignable.
    protected $fillable = ['name', 'note'];

    // Define any relationships here if needed.
    // For example, if a permission has many roles:
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }
}
