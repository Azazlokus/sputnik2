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
            'comment' => 'nullable|string|min:1|max:1000',
        ];
    }
    public function updateRules(): array
    {
        return [
            'relax_place_id' => 'required|exists:relax_places,id',//в updateRules наверно лучше убрать required
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|min:1|max:1000',
        ];
    }

}
