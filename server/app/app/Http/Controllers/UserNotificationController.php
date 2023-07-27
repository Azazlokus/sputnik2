<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserNotificationRequest;
use App\Http\Resources\UserNotificationResource;
use App\Models\User;
use App\Models\UserNotification;
use App\Policies\UserNotificationPolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;

class UserNotificationController extends Controller
{
    protected $model = UserNotification::class;
    protected $request = UserNotificationRequest::class;
    protected $resource = UserNotificationResource::class;
    protected $policy = UserNotificationPolicy::class;
    protected function buildFetchQuery( $request, array $requestedRelations): Builder
    {
        $query = parent::buildFetchQuery($request, $requestedRelations);
        $this->ifUserChangeQuery($query);
        return $query;
    }
    protected  function ifUserChangeQuery($query): void
    {
        $user = User::query()->find($this->getUserID());
        if($user->isUser()) {
            $query->where('user_id', $user->id);
        }
    }
    protected function getUserID()
    {
        return Auth::user()->getAuthIdentifier();
    }
}
