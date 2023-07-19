<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogoutResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'message' => 'Exit successfully completed',

        ];
    }
}
