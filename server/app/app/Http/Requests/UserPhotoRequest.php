<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;
class UserPhotoRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'image_name' => 'required|string',
            'path_to_photo' => 'required|string',
        ];
    }
}
