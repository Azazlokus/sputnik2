<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orion\Concerns\DisableAuthorization;
use  Orion\Http\Controllers\Controller;

class WishlistController extends Controller
{
    use DisableAuthorization;
    protected $model = WishlistController::class;
}
