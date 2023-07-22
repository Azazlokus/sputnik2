<?php

namespace App\Policies;

use App\Constants\RoleConstants;
use App\Models\RelaxPlaceCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RelaxPlaceCategoryPolicy
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
        return $this->allow();
    }


    public function view(User $user, RelaxPlaceCategory $placeCategory)
    {
        return $this->allow();
    }

    public function create(User $user): Response
    {
        return $this->deny();
    }

    public function update(User $user, RelaxPlaceCategory $placeCategory): Response {
        return $this->deny();
    }

    public function delete(User $user, RelaxPlaceCategory $placeCategory): Response
    {
        return $this->deny();
    }
    public function restore(User $user, RelaxPlaceCategory $placeCategory): Response
    {
        return $this->deny();
    }

    public function forceDelete(User $user, RelaxPlaceCategory $placeCategory): Response {
        return $this->deny();
    }
}
