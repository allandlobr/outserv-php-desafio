<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use App\Trait\CheckPermissionTrait;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    use CheckPermissionTrait;

    public function view(User $user): bool
    {
        return $this->checkPermission($user,'permission-view');
    }

    public function create(User $user): bool
    {
        return $this->checkPermission($user,'permission-create');
    }

    public function update(User $user): bool
    {
        return $this->checkPermission($user,'permission-update');
    }

    public function delete(User $user): bool
    {
        return $this->checkPermission($user,'permission-delete');
    }
}
