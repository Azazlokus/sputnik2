<?php

namespace App\Policies;

use App\Constants\RoleConstants;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RoleUserPolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        if ($user->isBlocked()) {
            return false;
        }

        return null;
    }
    public function viewAny(User $user)
    {
        return $this->allow();
    }


    public function view(User $user, RoleUser $roleUser)
    {
        return $user->id === $roleUser->user_id ? $this->allow() : $this->deny();
    }

    public function create(User $user): Response
    {
        return $this->deny();
    }

    public function update(User $user, RoleUser $roleUser): Response {
        return $this->deny();
    }

    public function delete(User $user, RoleUser $roleUser): Response
    {
        return $this->deny();
    }
    public function restore(User $user, RoleUser $roleUser): Response
    {
        return $this->deny();
    }

    public function forceDelete(User $user, RoleUser $roleUser): Response {
        return $this->deny();
    }
}
