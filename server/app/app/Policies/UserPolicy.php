<?php

namespace App\Policies;

use App\Constants\RoleConstants;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
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
    /**
     * Определение, может ли пользователь видеть список всех пользователей.
     *
     * @param  \App\Models\User  $user  Авторизованный пользователь.
     * @return Response
     */
    public function viewAny(User $user)
    {
        return $this->deny();
    }

    /**
     * Определение, может ли пользователь видеть профиль другого пользователя.
     *
     * @param  \App\Models\User  $user  Авторизованный пользователь.
     * @param  \App\Models\User  $profileUser  Пользователь, профиль которого просматривается.
     * @return Response
     */
    public function view(User $user, User $profileUser)
    {
        return $this->deny();
    }

    public function create(?User $user): Response
    {
        // Разрешаем создание новых пользователей для всех авторизованных пользователей.
        return $this->allow();
    }

    public function update(User $user, User $model): Response {
        return $this->deny();
    }

    public function delete(User $user, User $model): Response
    {
        return $this->deny();
    }
    public function restore(User $user, User $model): Response
    {
        return $this->deny();
    }

    public function forceDelete(User $user, User $model): Response {
        return $this->deny();
    }

}
