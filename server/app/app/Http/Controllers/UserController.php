<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\LoginResource;
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
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = Auth::attempt($credentials)) {


            return new LoginResource($token);
        }

        return response()->json(['error' => 'Ошибка входа'], 401);
    }
    public function logout(){
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Выход выполнен успешно']);
    }
    public function getCurrentUser(){
        $user = Auth::guard('api')->user();

        if ($user) {

            return response()->json(['user' => $user]);
        } else {

            return response()->json(['error' => 'Пользователь не аутентифицирован'], 401);
        }
    }


}
