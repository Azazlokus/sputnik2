<?php
namespace App\Http\Controllers;


use App\Http\Repositories\NotificationRepository;
use App\Models\UserNotification;
use Illuminate\Notifications\Notification;

class NotificationController
{
    private NotificationRepository $_notificationRepository;
    function __construct(NotificationRepository $notificationRepository)
    {
        $this->_notificationRepository = $notificationRepository;
    }
    public function getAll(){

        $notifications = $this->_notificationRepository->findAll();
        $count = $notifications->count();
        return response()->json(['success'=> 'true',
            'count' => $count,
            'notifications'=> $notifications
            ]);
    }
}
