<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class UserRecommendationRequest extends Request
{

    public function storeRules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'relax_place_id' => 'required|exists:relax_places,id',
        ];
    }
}
