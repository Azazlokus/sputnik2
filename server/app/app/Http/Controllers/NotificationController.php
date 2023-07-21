<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificatonRequest;
use App\Http\Resources\NotificationResource;
use App\Models\UserNotification;
use App\Policies\NotificationPolicy;
use Orion\Http\Controllers\Controller;

class NotificationController extends Controller
{
    protected $model = UserNotification::class;
    protected $request = NotificatonRequest::class;
    protected $resource = NotificationResource::class;
    protected $policy = NotificationPolicy::class;
}
