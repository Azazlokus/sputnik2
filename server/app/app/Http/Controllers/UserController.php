<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Orion\Concerns\DisableAuthorization;
use  Orion\Http\Controllers\Controller;
use Orion\Http\Controllers\RelationController;

class UserController extends Controller
{
    //use DisableAuthorization;
    protected $model = User::class;
    protected $request = UserRequest::class;
    protected $resource = UserResource::class;
    protected $policy = UserPolicy::class;

}
