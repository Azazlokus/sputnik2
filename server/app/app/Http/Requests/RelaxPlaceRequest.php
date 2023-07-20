<?php

namespace App\Http\Requests;



use Orion\Http\Requests\Request;

class RelaxPlaceRequest extends Request
{   /**

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function storeRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'average_rating' => 'required|numeric|min:0|max:5', // Assuming ratings range from 0 to 5
            'country' => 'required|string|max:255',
            'category' => 'required|exists:relax_place_categories,id',
        ];
    }
}
