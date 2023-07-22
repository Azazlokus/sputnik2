<?php

namespace App\Http\Controllers;

use App\Constants\RoleConstants;
use App\Http\Requests\UserWishlistRequest;
use App\Http\Resources\UserWishlistResource;
use App\Models\User;
use App\Models\UserWishlist;
use App\Policies\UserWishlistPolicy;
use http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;
use Orion\Specs\Builders\Builder;

class UserWishlistController extends Controller
{
    protected $resource = UserWishlistResource::class;
    protected $request = UserWishlistRequest::class;
    protected $model = UserWishlist::class;
    protected $policy = UserWishlistPolicy::class;
    protected function buildIndexFetchQuery( $request, array $requestedRelations): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $user = User::query()->find(Auth::user()->getAuthIdentifier());
        if($user->hasRole(RoleConstants::USER)) {
            $query->where('user_id', $user->id);
        }
        return $query;
    }
}
