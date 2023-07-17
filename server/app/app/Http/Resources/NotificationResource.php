<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        $count = $request->count();
        return [
            'success' => 'true',
            'count' => $count,
            'notifications' => $request
        ];
    }
}
