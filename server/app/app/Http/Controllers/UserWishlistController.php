<?php

namespace app\Http\Controllers;

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
    protected function buildIndexFetchQuery( $request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $user = User::query()->find(Auth::user()->getAuthIdentifier());
        if($user->isUser()) {
            $query->where('user_id', $user->id);
        }
        return $query;
    }
}
