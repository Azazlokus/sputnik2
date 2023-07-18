<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\LogoutResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mockery\Exception;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        /*$user = new User();
        $user->fill($request->only(['email', 'password']));
        $user->save();*/
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
        $credentials['password'] = Hash::make($credentials['password']);
        if ($token = auth()->attempt($credentials)) {
            return new LoginResource($token);
        }
        return response()->json([Auth::attempt($credentials)]);
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
