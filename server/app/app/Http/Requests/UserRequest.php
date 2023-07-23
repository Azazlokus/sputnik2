<?php

namespace App\Http\Requests;


use Orion\Http\Requests\Request;

class UserRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function storeRules(): array
    {
        return [
            'email' => 'required|string|min:1|max:255|email|unique:users',
            'password' => 'required|string|max:255|min:6|confirmed',
        ];
    }

}
