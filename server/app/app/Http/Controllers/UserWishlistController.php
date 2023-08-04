<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserWishlistRequest;
use App\Http\Resources\UserWishlistResource;
use App\Models\UserWishlist;
use App\Policies\UserWishlistPolicy;
use App\Traits\AggregateQueryForUserRole;
use Illuminate\Database\Eloquent\Builder;
use Orion\Http\Controllers\Controller;

class UserWishlistController extends Controller
{
    use AggregateQueryForUserRole;

    protected $resource = UserWishlistResource::class;
    protected $request = UserWishlistRequest::class;
    protected $model = UserWishlist::class;
    protected $policy = UserWishlistPolicy::class;

    protected function buildFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildFetchQuery($request, $requestedRelations);
        $this->changeQueryForUser($query);
        return $query;
    }

}
