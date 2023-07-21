<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistRequest;
use App\Http\Resources\WishlistResource;
use App\Models\UserWishlist;
use App\Policies\WishlistPolicy;
use Orion\Http\Controllers\Controller;

class WishlistController extends Controller
{
    protected $resource = WishlistResource::class;
    protected $request = WishlistRequest::class;
    protected $model = UserWishlist::class;
    protected $policy = WishlistPolicy::class;
}
