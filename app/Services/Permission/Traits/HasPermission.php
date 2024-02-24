<?php


namespace App\Services\Permission\Traits;


use App\Models\Permission;

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
        return Permission::whereIn('name', array_values($permissions))->get();
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
    public function removePermissionFrom(...$permissions)
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
