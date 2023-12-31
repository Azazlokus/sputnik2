<?php

namespace App\Http\Requests;



use Orion\Http\Requests\Request;

class RelaxPlaceRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'title' => 'required|string|min:1|max:255',
            'description' => 'nullable|string|min:1|max:1000|',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'average_rating' => 'required|numeric|min:1|max:5',
            'country' => 'required|string|min:1|max:255',
            'category' => 'required|exists:relax_place_categories,id',
        ];
    }
}
