<?php

namespace app\Http\Requests;



use Orion\Http\Requests\Request;

class RelaxPlaceCategoryRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'name' => 'required|string|min:1|max:255|unique:relax_place_categories',
        ];
    }
}
