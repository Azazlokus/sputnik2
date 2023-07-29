<?php

namespace App\Http\Controllers;


use App\Enums\NotificationTypeEnum;
use App\Http\Requests\RoleUserRequest;
use App\Http\Resources\RoleUserResource;
use App\Models\RoleUser;
use App\Models\UserNotification;
use App\Policies\RoleUserPolicy;
use App\Traits\AggregateQueryForUserRole;
use Illuminate\Database\Eloquent\Builder;
use Orion\Http\Controllers\Controller;

class RoleUserController extends Controller
{
    use AggregateQueryForUserRole;

    protected $model = RoleUser::class;
    protected $request = RoleUserRequest::class;
    protected $resource = RoleUserResource::class;
    protected $policy = RoleUserPolicy::class;

    protected function buildIndexFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->changeQueryForUser($query);
        return $query;
    }

}
