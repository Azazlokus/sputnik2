<?php

namespace App\Policies;

use App\Constants\RoleConstants;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\UserWishlist;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserNotificationPolicy
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


    public function view(User $user, UserNotification $userNotification)
    {
        return $this->allow();
    }

    public function create(User $user): Response
    {
        return $this->deny();
    }

    public function update(User $user, UserNotification $userNotification): Response {
        return $this->deny();
    }

    public function delete(User $user, UserNotification $userNotification): Response
    {
        return $this->deny();
    }
    public function restore(User $user, UserNotification $userNotification): Response
    {
        return $this->deny();
    }

    public function forceDelete(User $user, UserNotification $userNotification): Response {
        return $this->deny();
    }
}
