<?php

namespace App\Policies;

use App\Constants\RoleConstants;
use App\Models\RelaxPlace;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RelaxPlacePolicy
{
    use HandlesAuthorization;
    /* Админ может все, заблокированный ничего, обычный пользователь
 может просматривать все места, и по id*/
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


    public function view(User $user, RelaxPlace $relaxPlace)
    {
        return $this->allow();
    }

    public function create(User $user): Response
    {
        return $this->deny();
    }

    public function update(User $user, RelaxPlace $model): Response {
        return $this->deny();
    }

    public function delete(User $user, RelaxPlace $model): Response
    {
        return $this->deny();
    }

    public function restore(User $user, RelaxPlace $model): Response
    {
        return $this->deny();
    }

    public function forceDelete(User $user, RelaxPlace $model): Response {
        return $this->deny();
    }
}
