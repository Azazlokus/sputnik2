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
        $count = $notifications->count();
        return /*new NotificationResource($notifications);*/
            response()->json(['success' => 'true',
            'count' => $count,
            'notifications' => $notifications
        ]);
    }
}
