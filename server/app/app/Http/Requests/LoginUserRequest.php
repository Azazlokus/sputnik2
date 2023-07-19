<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'email' => 'required|string|max:255|email',
            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'It is necessary to fill in the required field :attribute',
            '*.email' => 'Field :attribute must be an email address',
            '*.min' => 'Field :attribute must be at least 6 characters long',
        ];
    }

}
