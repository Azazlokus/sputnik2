<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Traits\IfUserThenSelectsQuery;
use Illuminate\Database\Eloquent\Builder;
use Orion\Http\Controllers\Controller;

class UserController extends Controller
{
    use IfUserThenSelectsQuery;

    protected $model = User::class;
    protected $request = UserRequest::class;
    protected $resource = UserResource::class;
    protected $policy = UserPolicy::class;

    protected function buildIndexFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->ifUserShowYourself($query);
        return $query;
    }

}
