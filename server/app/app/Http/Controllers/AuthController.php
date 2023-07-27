<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\LogoutResource;
use App\Models\Role; //Неиспользуемые use по хорошему надо удалять
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception; // Зачем Mockery? это же пакет для тестов


class AuthController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = auth()->attempt($credentials)) {
            return new LoginResource($token);
        }
        throw new Exception('Login error', 401); //Зачем кидать обычный exception и передавать в него код
        // в Exception handlere код вытаскивается методом getStatusCode, которого в этом exception нет
        // и в случае ошибки вернется 500 а не 401, можно создать собственное исключение с этим методом
        // или найти готовое. Вместо 401 можно использовать константу.

    }

    public function logout()
    {
        $user = Auth::guard('api')->user();
        Auth::guard('api')->logout();
        return new LogoutResource($user);
    }

}
