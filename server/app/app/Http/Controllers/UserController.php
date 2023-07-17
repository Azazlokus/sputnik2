<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\LogoutResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mockery\Exception;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        $user = User::query()->create([
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
        throw new Exception();
    }

    public function logout()
    {
        $user = Auth::guard('api')->user();
        Auth::guard('api')->logout();
        return new LogoutResource($user);
    }

    public function index()
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            return new UserResource($user);
        }
        throw new Exception();
    }


}
