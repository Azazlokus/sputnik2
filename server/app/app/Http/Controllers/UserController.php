<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        $user = User::create([
            'id' => Str::uuid()->toString(),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return new UserResource($user);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            //$token = $user->createToken('MyToken')->plainTextToken;

            return response()->json([
                'token' => Auth::attempt($credentials),
                'token_type' => 'Bearer',
                'expires_in' => config('auth.token_expires_in'),
            ]);
        }

        abort(401, 'Unauthorized');
    }
    public function logout(){
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Выход выполнен успешно']);
    }
    public function getCurrentUser(){
        $user = Auth::guard('api')->user();

        if ($user) {
            // Если пользователь аутентифицирован, возвращаем информацию о нем
            return response()->json(['user' => $user]);
        } else {
            // Если пользователь не аутентифицирован, возвращаем сообщение об ошибке
            return response()->json(['error' => 'Пользователь не аутентифицирован'], 401);
        }
    }


}
