<?php

namespace App\Http\Controllers;


use App\Http\Requests\RoleUserRequest;
use App\Http\Resources\RoleUserResource;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\UserNotification;
use App\Policies\RoleUserPolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;

class RoleUserController extends Controller
{

    protected $model = RoleUser::class;
    protected $request = RoleUserRequest::class;
    protected $resource = RoleUserResource::class;
    protected $policy =RoleUserPolicy::class;

    protected function buildIndexFetchQuery( $request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $user = User::query()->find(Auth::user()->getAuthIdentifier());
        if($user->isUser()) {
            $query->where('user_id', $user->id);
        }
        return $query;
    }
    protected function buildStoreFetchQuery( $request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->sendBlockNotifications(Auth::user()->getAuthIdentifier());
        return $query;
    }
    protected function buildDestroyFetchQuery( $request, array $requestedRelations, bool $softDeletes): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->sendUnblockNotifications(Auth::user()->getAuthIdentifier());
        return $query;
    }
    public function sendBlockNotifications($userId): void
    {
        UserNotification::query()->create([
            'user_id' => $userId,
            'type' => 'push',
            'content' => 'User with id: ' . $userId . ', you have been blocked.'
        ]);
    }
    public function sendUnblockNotifications($userId): void
    {
        UserNotification::query()->create([
            'user_id' => $userId,
            'type' => 'push',
            'content' => 'User with id: ' . $userId . ', you have been unblocked.'
        ]);
    }
}
