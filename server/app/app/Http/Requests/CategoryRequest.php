<?php

namespace App\Http\Requests;



use Orion\Http\Requests\Request;

class CategoryRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
