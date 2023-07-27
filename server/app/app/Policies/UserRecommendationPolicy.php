<?php

namespace App\Policies;

use App\Models\Rating;
use App\Models\User;
use App\Models\UserRecommendation;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserRecommendationPolicy
{    use HandlesAuthorization; //от такого форматирования хочется плакать
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }
    public function viewAny(User $user)
    {
        return $this->allow();
    }
    public function view(User $user, UserRecommendation $userRecommendation)
    {
        return $this->allow();
    }

    public function create(User $user): Response
    {
        return $this->deny();
    }

    public function update(User $user, UserRecommendation $userRecommendation): Response {
        return $this->deny();
    }

    public function delete(User $user, UserRecommendation $userRecommendation): Response
    {
        return $this->deny();
    }
    public function restore(User $user, UserRecommendation $userRecommendation): Response
    {
        return $this->deny();
    }

    public function forceDelete(User $user, UserRecommendation $userRecommendation): Response {
        return $this->deny();
    }
}
