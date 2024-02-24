<?php


namespace App\Services\Permission\Traits;


use App\Models\Role;
use Illuminate\Support\Arr;

trait HasRoles
{

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // get all roles
    protected function getAllRoles(array $roles)
    {
        return Role::whereIn('name', Arr::flatten($roles))->get();
    }


    public function giveRolesTo(...$roles)
    {
        $roles = $this->getAllRoles($roles);
        if ($roles->isEmpty()) return $this;
        $this->roles()->syncWithoutDetaching($roles);
        return $this;
    }

    public function removeRolesFrom(...$roles)
    {
        $roles = $this->getAllRoles($roles);
        $this->roles()->detach($roles);
        return $this;
    }

    public function refreshRoles(...$permissions)
    {
        $roles = $this->getAllRoles($permissions);
        $this->roles()->sync($roles);
        return $this;
    }

    //// for check a user has a specific role or not
    ///
    public function hasRole(string $role)
    {
        return $this->roles->contains('name',$role);
    }

    //    public function hasRole(Role $role)
    //    {
    //        return $this->roles->contains($role);
    //    }

}
