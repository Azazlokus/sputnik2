<?php

namespace App\Http\Controllers;

use App\Constants\RoleConstants;
use App\Http\Requests\WishlistRequest;
use App\Http\Resources\WishlistResource;
use App\Models\User;
use App\Models\UserWishlist;
use App\Policies\WishlistPolicy;
use http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;
use Orion\Specs\Builders\Builder;

class WishlistController extends Controller
{
    protected $resource = WishlistResource::class;
    protected $request = WishlistRequest::class;
    protected $model = UserWishlist::class;
    protected $policy = WishlistPolicy::class;
    protected function buildIndexFetchQuery( $request, array $requestedRelations): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $user = User::query()->find(Auth::user()->getAuthIdentifier());
        if($user->hasRole(RoleConstants::USER)) {
            $query->where('user_id', Auth::user()->getAuthIdentifier());
        }
        return $query;
    }
}
