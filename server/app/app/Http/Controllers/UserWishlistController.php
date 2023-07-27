<?php

namespace App\Http\Controllers;

use App\Constants\RoleConstants;
use App\Http\Requests\UserWishlistRequest;
use App\Http\Resources\UserWishlistResource;
use App\Models\User;
use App\Models\UserWishlist;
use App\Policies\UserWishlistPolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;

class UserWishlistController extends Controller
{
    protected $resource = UserWishlistResource::class;
    protected $request = UserWishlistRequest::class;
    protected $model = UserWishlist::class;
    protected $policy = UserWishlistPolicy::class;
    protected function buildFetchQuery( $request, array $requestedRelations): Builder
    {
        $query = parent::buildFetchQuery($request, $requestedRelations);
        $this->ifUserCnangeQuery($query);
        return $query;
    }
    protected  function ifUserCnangeQuery($query){
        $user = User::query()->find($this->getUserId());
        if($user->isUser()) {
            $query->where('user_id', $user->id);
        }
    }
    protected function getUserId(){
        return Auth::user()->getAuthIdentifier();
    }
}
