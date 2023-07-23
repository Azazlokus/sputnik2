<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;
class UserPhotoRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'image_name' => 'required|string|min:1|max:255',
            'path_to_photo' => 'required|string|min:1|max:255',
        ];
    }
}
