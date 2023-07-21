<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPhotoRequest;
use App\Http\Resources\UserPhotoResource;
use App\Models\UserPhoto;
use App\Policies\UserPhotoPolicy;
use Orion\Http\Controllers\Controller;

class UserPhotoController extends Controller
{
    protected $model = UserPhoto::class;
    protected $request = UserPhotoRequest::class;
    protected $resource = UserPhotoResource::class;
    protected $policy = UserPhotoPolicy::class;
}
