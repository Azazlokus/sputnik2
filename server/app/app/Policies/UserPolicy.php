<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
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

    public function view(User $user, User $profileUser)
    {
        return $user->id === $profileUser->id ? $this->allow() : $this->deny();
    }

    public function create(?User $user): Response
    {
        return $this->allow();
    }

    public function update(User $user, User $profileUser): Response
    {
        return $user->id === $profileUser->id ? $this->allow() : $this->deny();
    }

    public function delete(User $user, User $model): Response
    {
        return $this->deny();
    }

    public function restore(User $user, User $model): Response
    {
        return $this->deny();
    }

    public function forceDelete(User $user, User $model): Response
    {
        return $this->deny();
    }

}
