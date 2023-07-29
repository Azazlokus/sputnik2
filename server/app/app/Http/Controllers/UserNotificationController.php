<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserNotificationRequest;
use App\Http\Resources\UserNotificationResource;
use App\Models\User;
use App\Models\UserNotification;
use App\Policies\UserNotificationPolicy;
use App\Traits\IfUserThenSelectsQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;

class UserNotificationController extends Controller
{
    use IfUserThenSelectsQuery;

    protected $model = UserNotification::class;
    protected $request = UserNotificationRequest::class;
    protected $resource = UserNotificationResource::class;
    protected $policy = UserNotificationPolicy::class;

    protected function buildIndexFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->ifUserChangeQuery($query);
        return $query;
    }
}
