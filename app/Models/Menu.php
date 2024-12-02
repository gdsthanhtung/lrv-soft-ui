<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'url',
        'icon',
        'order',
        'permission',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the user who created the menu.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the menu.
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the parent menu.
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Get the child menus.
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }
}
