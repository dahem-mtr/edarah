<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use HasFactory;
    public $actions = ['edit', 'delete'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    public function permissionsAdd($permissionIDs)
    {

        return $this->permissions()->syncWithoutDetaching($permissionIDs);
    }

    public function permissionsRemove($permissionIDs)
    {

        return $this->permissions()->detach($permissionIDs);
    }



}
