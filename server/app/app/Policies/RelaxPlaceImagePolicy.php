<?php

namespace App\Policies;

use App\Constants\RoleConstants;
use App\Models\Rating;
use App\Models\RelaxPlaceImage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RelaxPlaceImagePolicy
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


    public function view(User $user, RelaxPlaceImage $relaxPlaceImage)
    {
        return $this->allow();
    }

    public function create(User $user): Response
    {
        return $this->deny();
    }

    public function update(User $user, RelaxPlaceImage $relaxPlaceImage): Response {
        return $this->deny();
    }

    public function delete(User $user, RelaxPlaceImage $relaxPlaceImage): Response
    {
        return $this->deny();
    }
    public function restore(User $user, RelaxPlaceImage $relaxPlaceImage): Response
    {
        return $this->deny();
    }

    public function forceDelete(User $user, RelaxPlaceImage $relaxPlaceImage): Response {
        return $this->deny();
    }
}
