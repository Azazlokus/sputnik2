<?php

namespace App\Policies;

use App\Constants\RoleConstants;
use App\Models\User;
use App\Models\UserWishlist;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class NotificationPolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole(RoleConstants::ADMIN)) {
            return true;
        }
        if ($user->hasRole(RoleConstants::USER_BLOCKED)) {
            return false;
        }

        return null;
    }
    public function viewAny(User $user)
    {
        return $this->deny();
    }


    public function view(User $user, UserWishlist $userWishlist)
    {
        return $this->allow();
    }

    public function create(User $user): Response
    {
        return $this->deny();
    }

    public function update(User $user, UserWishlist $userWishlist): Response {
        return $this->deny();
    }

    public function delete(User $user, UserWishlist $userWishlist): Response
    {
        return $this->deny();
    }
    public function restore(User $user, UserWishlist $userWishlist): Response
    {
        return $this->deny();
    }

    public function forceDelete(User $user, UserWishlist $userWishlist): Response {
        return $this->deny();
    }
}
