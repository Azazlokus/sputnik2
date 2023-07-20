<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificatonRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Notifications\Notification;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;

class NotificationController extends Controller
{
    use DisableAuthorization;

    protected $model = Notification::class;
    protected $request = NotificatonRequest::class;
    protected $resource = NotificationResource::class;

    protected $relation = 'users';
}
