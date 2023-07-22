<?php

namespace App\Http\Requests;



use Orion\Http\Requests\Request;

class RelaxPlaceRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'average_rating' => 'required|numeric',
            'country' => 'required|string|max:255',
            'category' => 'required|exists:relax_place_categories,id',
        ];
    }
}
