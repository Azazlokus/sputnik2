<?php

namespace app\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogoutResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'message' => 'Exit successfully completed',
        ];
    }
}
