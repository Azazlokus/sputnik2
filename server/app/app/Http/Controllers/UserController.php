<?php

namespace App\Http\Controllers;

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

    protected function buildFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildFetchQuery($request, $requestedRelations);
        $this->ifUserShowYourself($query);
        return $query;
    }

    protected function ifUserShowYourself($query): void
    {
        $user = User::query()->find(Auth::user()->getAuthIdentifier());
        if ($user->isUser()) {
            $query->where('id', $user->id);
        }
    }
}
