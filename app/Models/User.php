<?php

namespace App\Models;

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
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public $actions = ['browse', 'create', 'edit', 'delete'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function hasRole($role)
    {
        $authRoles = $this->roles->pluck('name')->toArray();
        return in_array($role, $authRoles);
    }

    public function rolesAdd($roleIds)
    {
        return $this->roles()->syncWithoutDetaching($roleIds);
    }

    public function rolesRemove($roleIds)
    {
        return $this->roles()->detach($roleIds);
    }

    public function isAuthorizedTo($model, $permission)
    {
        $roles = $this->roles()->with(['permissions' => fn($query) => $query->where('model', $model)])->get();

        if ($roles->contains('name', 'manager')) {
            return true;
        }

        foreach ($roles as $role) {
            if ($role->permissions->contains('name', $permission)) {
                return true;
            }
        }
        return false;

    }

    public function permissionsOn($model)
    {
        $roles = $this->roles()->with(['permissions' => fn($q) => $q->where('model', $model)])->get();
        $permissions = [];

        if ($roles->contains('name', 'manager')) {
            if (class_exists('App\Models\\' . $model)) {
                return app("App\Models\\" . $model)->actions;
            }
        }
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                $permissions[] = $permission->name;
            };

        };
        return array_unique($permissions);
    }

    public function permissionsOnModels($models)
    {
        $roles = $this->roles()->with(['permissions' => fn($q) => $q->whereIn('model', $models)])->get();
        $permissions = [];

        if ($roles->contains('name', 'manager')) {

            foreach ($models as $model) {
                if (class_exists('App\Models\\' . $model)) {
                    $permissions[$model] = app("App\Models\\" . $model)->actions;
                }

            }
            return $permissions;
        }

        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                $permissions[$permission->model][] = $permission->name;
            };
        };
        return $permissions;
    }

   
    public function profile()
    {
        return $this->hasOne(ProfileUser::class, 'user_id');
    }

}
