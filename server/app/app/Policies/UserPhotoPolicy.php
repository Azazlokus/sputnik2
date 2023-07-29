<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserPhoto;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPhotoPolicy
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


    public function view(User $user, UserPhoto $userPhoto)
    {
        return $user->id === $userPhoto->user_id ? $this->allow() : $this->deny();
    }

    public function create(User $user): Response
    {
        return $this->allow();
    }

    public function update(User $user, UserPhoto $userPhoto): Response {
        return $user->id === $userPhoto->user_id ? $this->allow() : $this->deny();
    }

    public function delete(User $user, UserPhoto $userPhoto): Response
    {
        return $user->id === $userPhoto->user_id ? $this->allow() : $this->deny();
    }
    public function restore(User $user, UserPhoto $userPhoto): Response
    {
        return $this->deny();
    }

    public function forceDelete(User $user, UserPhoto $userPhoto): Response {
        return $this->deny();
    }
}
