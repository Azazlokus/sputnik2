<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserNotificationRequest;
use App\Http\Resources\UserNotificationResource;
use App\Models\UserNotification;
use App\Policies\UserNotificationPolicy;
use Orion\Http\Controllers\Controller;

class UserNotificationController extends Controller
{
    protected $model = UserNotification::class;
    protected $request = UserNotificationRequest::class;
    protected $resource = UserNotificationResource::class;
    protected $policy = UserNotificationPolicy::class;
}
