<?php
namespace App\Http\Controllers;


use App\Models\UserNotification;
use Illuminate\Notifications\Notification;

class NotificationController
{
    public function getAll(){
        return response()->json(['notifications'=> UserNotification::all()]);
    }
}
