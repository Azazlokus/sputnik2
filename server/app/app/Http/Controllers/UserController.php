<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Policies\UserPolicy;
use Orion\Http\Controllers\Controller;



class UserController extends Controller
{
    protected $model = User::class;
    protected $request = UserRequest::class;
    protected $resource = UserResource::class;
    protected $policy = UserPolicy::class;

}
