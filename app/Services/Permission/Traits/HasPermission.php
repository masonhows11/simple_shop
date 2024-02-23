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

    //// assign permissions to user
    public function givePermissionsTo(...$permissions)
    {

        $permissions = $this->getAllPermissions($permissions);
        dd($permissions);
    }


    protected function getAllPermissions(array  $permissions){
        return  Permission::whereIn('name',array_values($permissions))->get();
    }

}
