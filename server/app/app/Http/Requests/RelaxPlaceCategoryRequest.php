<?php

namespace App\Http\Requests;



use Orion\Http\Requests\Request;

class RelaxPlaceCategoryRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
