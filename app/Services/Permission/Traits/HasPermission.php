<?php


namespace App\Services\Permission\Traits;


use App\Models\Permission;
use Illuminate\Support\Arr;

trait HasPermission
{

    //// make many to many relation with user model
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }

    // get all permissions
    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('name', Arr::flatten($permissions))->get();
    }

    //// assign permissions to user
    public function givePermissionsTo(...$permissions)
    {

        $permissions = $this->getAllPermissions($permissions);
        if ($permissions->isEmpty()) return $this;
        $this->permissions()->syncWithoutDetaching($permissions);
        return $this;
    }

    //// detach permission from user
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

    //// for check a user has a specific permission or not
    //    public function hasPermission(string $permission)
    //    {
    //        return $this->permissions->contains('name',$permission);
    //    }

    public function hasPermission(Permission $permission)
    {

        return  $this->hasPermissionThrowRole($permission) || $this->permissions->contains($permission);
    }

    protected function hasPermissionThrowRole(Permission $permission)
    {

        // first get roles belongs to current permission
        // then check belong role is equal to given role
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) return true;
        }
        return false;

    }

}
