<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;
class RoleUserRequest extends Request
{
    protected $table = 'role_user';
    public function storeRules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'role_id'=>'required|integer|exists:roles,id'
        ];
    }
}
