<?php


namespace App\Services\Permission\Traits;


use App\Models\Role;

trait HasRoles
{

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // get all roles
    protected function getAllRoles(array $roles)
    {
        return Role::whereIn('name', array_values($roles))->get();
    }


    public function giveRolesTo(...$roles)
    {
        $roles = $this->getAllRoles($roles);
        if ($roles->isEmpty()) return $this;
        $this->roles()->syncWithoutDetaching($roles);
        return $this;
    }

    public function removePermissionsFrom(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermissions(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->sync($permissions);
        return $this;
    }

}
