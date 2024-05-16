<?php

namespace App\Policies;

use App\Models\User;
use App\Trait\CheckPermissionTrait;

class UserPolicy
{
    use CheckPermissionTrait;

    public function view(User $user): bool
    {
        return $this->checkPermission($user,'user-view');
    }

    public function create(User $user): bool
    {
        return $this->checkPermission($user,'user-create');
    }

    public function update(User $user): bool
    {
        return $this->checkPermission($user,'user-update');
    }

    public function delete(User $user): bool
    {
        return $this->checkPermission($user,'user-delete');
    }
}
