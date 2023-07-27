<?php

namespace App\Policies;

use App\Constants\RoleConstants;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RatingPolicy
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
    public function view(User $user, Rating $rating)
    {
        return $this->allow();
    }

    public function create(User $user): Response
    {
        return $this->allow();
    }

    public function update(User $user, Rating $rating): Response {
        return $this->allow();
    }

    public function delete(User $user, Rating $rating): Response
    {
        return $this->allow();
    }
    public function restore(User $user, Rating $rating): Response
    {
        return $this->allow();
    }

    public function forceDelete(User $user, Rating $rating): Response {
        return $this->allow();
    }
}
