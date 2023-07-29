<?php

namespace App\Http\Controllers;


use App\Http\Requests\RoleUserRequest;
use App\Http\Resources\RoleUserResource;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\UserNotification;
use App\Policies\RoleUserPolicy;
use App\Traits\IfUserThenSelectsQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;

class RoleUserController extends Controller
{
    use IfUserThenSelectsQuery;

    protected $model = RoleUser::class;
    protected $request = RoleUserRequest::class;
    protected $resource = RoleUserResource::class;
    protected $policy = RoleUserPolicy::class;

    protected function buildIndexFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->ifUserChangeQuery($query);
        return $query;
    }

    protected function buildStoreFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->sendBlockNotifications($this->getUserID());
        return $query;
    }

    protected function buildDestroyFetchQuery($request, array $requestedRelations, bool $softDeletes): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->sendUnblockNotifications($this->getUserID());
        return $query;
    }

    protected function sendBlockNotifications($userId): void
    {
        UserNotification::query()->create([
            'user_id' => $userId,
            'type' => 'push',
            'content' => 'User with id: ' . $userId . ', you have been blocked.'
        ]);
    }

    protected function sendUnblockNotifications($userId): void
    {
        UserNotification::query()->create([
            'user_id' => $userId,
            'type' => 'push',
            'content' => 'User with id: ' . $userId . ', you have been unblocked.'
        ]);
    }
}
