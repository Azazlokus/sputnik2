<?php

namespace app\Http\Requests;

use App\Constants\NotificationTypeConstants;
use Orion\Http\Requests\Request;

class UserNotificationRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'type' => 'required|string|min:1|max:255|in:' . NotificationTypeConstants::PUSH . ',' . NotificationTypeConstants::MAIL,
            'content' => 'nullable|string|min:1|max:1000',
            'viewed' => 'prohibited',
        ];
    }
}
