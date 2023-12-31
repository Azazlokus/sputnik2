<?php

namespace App\Http\Requests;



use Orion\Http\Requests\Request;

class UserWishlistRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'relax_place_id' => 'required|integer|exists:relax_places,id',
            'visit_time' => 'nullable|date_format:Y-m-d'
        ];
    }
    public function updateRules(): array
    {
        return [
            'user_id' => 'prohibited',
            'relax_place_id' => 'prohibited',
            'visit_time' => 'required|date_format:Y-m-d'
        ];
    }
}
