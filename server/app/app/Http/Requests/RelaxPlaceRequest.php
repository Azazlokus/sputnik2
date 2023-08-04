<?php

namespace App\Http\Requests;



use App\Enums\CountryEnum;
use App\Enums\NotificationTypeEnum;
use Illuminate\Validation\Rule;
use Orion\Http\Requests\Request;

class RelaxPlaceRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'title' => 'required|string|min:1|max:255',
            'description' => 'nullable|string|min:1|max:1000|',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'average_rating' => 'prohibited',
            'country' => ['required','string', Rule::in(CountryEnum::getEnumValues(CountryEnum::class))],
            'category_id' => 'required|exists:relax_place_categories,id',
        ];
    }
}
