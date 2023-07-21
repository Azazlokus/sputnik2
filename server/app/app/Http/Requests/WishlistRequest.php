<?php

namespace App\Http\Requests;



use Orion\Http\Requests\Request;

class WishlistRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'user_id' => 'required|integer',
            'relax_place_id' => 'required|integer',
            'visit_time' => 'nullable|date_format:Y-m-d H:i:s'
        ];
    }
}
