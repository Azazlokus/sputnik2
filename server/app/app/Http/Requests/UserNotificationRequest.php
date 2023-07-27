<?php

namespace App\Http\Requests;

use App\Constants\NotificationTypeConstants;
use Orion\Http\Requests\Request;

class UserNotificationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function storeRules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            //Некрасивый костыль
            //Можно например сделать так:
            //'type' => ['required','string','min:1','max:255',Rule::in([NotificationTypeConstants::PUSH , NotificationTypeConstants::MAIL])]
            'type' => 'required|string|min:1|max:255|in:' . NotificationTypeConstants::PUSH . ',' . NotificationTypeConstants::MAIL,
            'content' => 'nullable|string|min:1|max:1000',
            'viewed' => 'prohibited',
        ];
    }
}
