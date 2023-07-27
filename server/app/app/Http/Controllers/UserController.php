<?php

namespace App\Http\Controllers;

use App\Constants\RoleConstants;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $model = User::class;
    protected $request = UserRequest::class;
    protected $resource = UserResource::class;
    protected $policy = UserPolicy::class;
    //Опять много логики
    protected function buildIndexFetchQuery( $request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->ifUserChangeQuery($query);
        return $query;
    }
    protected function buildShowFetchQuery( $request, array $requestedRelations): Builder
    {
        $query = parent::buildShowFetchQuery($request, $requestedRelations);
        $this->ifUserChangeQuery($query);
        return $query;
    }
    protected function buildUpdateFetchQuery( $request, array $requestedRelations): Builder
    {
        $query = parent::buildUpdateFetchQuery($request, $requestedRelations);
        $this->ifUserChangeQuery($query);
        return $query;
    }
    protected  function ifUserChangeQuery($query): void
    {
        $user = User::query()->find($this->getUserID());
        if($user->isUser()) {
            $query->where('id', $user->id);
        }
    }
    protected function getUserID()
    {
        return Auth::user()->getAuthIdentifier();
    }
}
