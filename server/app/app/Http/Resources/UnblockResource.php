<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnblockResource extends JsonResource //Ресурс не используется нигде, наверно стоит удалить
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => 'User with id: '. $request->user->id .' unblocked successfully',
        ];
    }
}
