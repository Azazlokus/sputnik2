<?php

namespace app\Http\Requests;

use Orion\Http\Requests\Request;

class UserRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'email' => 'required|string|min:1|max:255|email|unique:users',
            'password' => 'required|string|max:255|min:6|confirmed',
        ];
    }

}
