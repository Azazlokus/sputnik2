<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(
        ?User $user
    ): Response {
        return $this->deny();
    }

    public function view(
        ?User $user,
        User $model
    ): Response {
        return $this->deny();
    }

    public function create(
        User $user
    ): Response {
        return $this->allow();
    }

    public function update(
        ?User $user,
        User $model
    ): Response {
        return $this->deny();
    }

    public function delete(
        ?User $user,
        User $model
    ): Response {
        return $this->deny();
    }

    public function restore(
        ?User $user,
        User $model
    ): Response {
        return $this->deny();
    }

    public function forceDelete(
        ?User $user,
        User $model
    ): Response {
        return $this->deny();
    }

}
