<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class NotificatonRequest extends Request
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
            'type' => 'required|string|max:255',
            'content' => 'string',
            'viewed' => 'boolean',
        ];
    }
}
