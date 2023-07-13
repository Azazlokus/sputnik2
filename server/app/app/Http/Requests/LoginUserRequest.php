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
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Необходимо заполнить  обязательное поле :attribute',
            '*.email' => 'Поле :attribute должно быть адресом электронной почты',
            '*.min' => 'Поле :attribute должно быть длиной не менее 6 символов',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'email',
            'password' => 'Пароль',
        ];
    }

    /*protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        Log::error("Ошибка при входе пользователя.");
        Log::error(json_encode($errors, JSON_UNESCAPED_UNICODE));
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }*/
}
