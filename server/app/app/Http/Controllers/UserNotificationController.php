<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserNotificationRequest;
use App\Http\Resources\UserNotificationResource;
use App\Models\UserNotification;
use App\Policies\UserNotificationPolicy;
use App\Traits\AggregateQueryForUserRole;
use Illuminate\Database\Eloquent\Builder;
use Orion\Http\Controllers\Controller;

class UserNotificationController extends Controller
{
    use AggregateQueryForUserRole;

    protected $model = UserNotification::class;
    protected $request = UserNotificationRequest::class;
    protected $resource = UserNotificationResource::class;
    protected $policy = UserNotificationPolicy::class;

    protected function buildIndexFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->changeQueryForUser($query);
        return $query;
    }
}
