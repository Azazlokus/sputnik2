<?php

namespace App\Http\Requests;

use App\Enums\NotificationTypeEnum;
use Illuminate\Validation\Rule;
use Orion\Http\Requests\Request;

class UserNotificationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     * @throws \ReflectionException
     */
    public function storeRules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'type' => ['required', 'string',
                Rule::in(NotificationTypeEnum::getEnumValues(NotificationTypeEnum::class))],
            'content' => 'nullable|string|min:1|max:1000',
            'viewed' => 'prohibited',
        ];
    }
}
