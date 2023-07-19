<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\UserNotification;
use Illuminate\Notifications\Notification;

class NotificationController
{
    public function index()
    {
        $notifications = UserNotification::query()->get();
        return [
            "success" => true,
            "count" => $notifications->count(),
            "notifications" => NotificationResource::collection($notifications)
        ];
    }
}
