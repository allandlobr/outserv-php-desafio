<?php

namespace App\Trait;

use App\Models\Permission;
use App\Models\User;

trait CheckPermissionTrait
{
    public function checkPermission(User $user, string $permissionName)
    {
        return $user->profile->permissions->contains(function (Permission $permission) use ($permissionName) {
            return $permission->slug_name === $permissionName;
        });
    }
}
