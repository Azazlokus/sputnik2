<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserWishlist;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserWishlistPolicy
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


    public function view(User $user, UserWishlist $userWishlist)
    {
        return $user->id === $userWishlist->user_id ? $this->allow() : $this->deny();
    }

    public function create(User $user): Response
    {
        return $this->allow();
    }

    public function update(User $user, UserWishlist $userWishlist): Response
    {
        return $user->id === $userWishlist->user_id ? $this->allow() : $this->deny();
    }

    public function delete(User $user, UserWishlist $userWishlist): Response
    {
            return $this->allow();
    }
    public function restore(User $user, UserWishlist $userWishlist): Response
    {
        return $this->deny();
    }

    public function forceDelete(User $user, UserWishlist $userWishlist): Response
    {
        return $this->deny();
    }
}

