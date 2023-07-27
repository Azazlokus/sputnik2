<?php

namespace App\Http\Requests;



use Orion\Http\Requests\Request;

class RelaxPlaceImageRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'relax_place_id' => 'required|exists:relax_places,id',
            'image_name' => 'required|string|min:1|max:255',
            'path_to_image' => 'required|string|min:1|max:255',
        ];
    }
}
