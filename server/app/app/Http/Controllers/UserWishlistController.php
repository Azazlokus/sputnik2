<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\UserWishlistRequest;
use App\Http\Resources\UserWishlistResource;
use App\Models\User;
use App\Models\UserWishlist;
use App\Policies\UserWishlistPolicy;
use App\Traits\AggregateQueryForUserRole;
use Exception;
use http\Env\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;

class UserWishlistController extends Controller
{
    use AggregateQueryForUserRole;

    protected $resource = UserWishlistResource::class;
    protected $request = UserWishlistRequest::class;
    protected $model = UserWishlist::class;
    protected $policy = UserWishlistPolicy::class;

    protected function buildIndexFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->changeQueryForUser($query);
        return $query;
    }

}
