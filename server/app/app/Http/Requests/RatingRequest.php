<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;
class RatingRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'relax_place_id' => 'required|exists:relax_places,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ];
    }
}
