<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;
use App\Trait\CheckPermissionTrait;
use Illuminate\Auth\Access\Response;

class ProfilePolicy
{
    use CheckPermissionTrait;

    public function view(User $user): bool
    {
        return $this->checkPermission($user,'profile-view');
    }

    public function create(User $user): bool
    {
        return $this->checkPermission($user,'profile-create');
    }

    public function update(User $user): bool
    {
        return $this->checkPermission($user,'profile-update');
    }

    public function delete(User $user): bool
    {
        return $this->checkPermission($user,'profile-delete');
    }
}
