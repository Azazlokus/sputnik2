<?php

namespace App\Http\Repositories;

use App\Models\UserNotification;

class NotificationRepository {
    public function findAll(){
        return UserNotification::all();
    }
}
