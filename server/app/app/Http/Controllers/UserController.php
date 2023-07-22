<?php

namespace App\Http\Controllers;

use App\Constants\RoleConstants;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Policies\UserPolicy;

use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;


class UserController extends Controller
{
    protected $model = User::class;
    protected $request = UserRequest::class;
    protected $resource = UserResource::class;
    protected $policy = UserPolicy::class;
    protected function buildIndexFetchQuery( $request, array $requestedRelations): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $user = User::query()->find(Auth::user()->getAuthIdentifier());
        if($user->hasRole(RoleConstants::USER)) {
            $query->where('id', $user->id);
        }
        return $query;
    }


}
