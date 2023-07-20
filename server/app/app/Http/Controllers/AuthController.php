<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\LogoutResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;


class AuthController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = auth()->attempt($credentials)) {
            return new LoginResource($token);
        }
        throw new Exception('Login error', 401);
    }

    public function logout()
    {
        $user = Auth::guard('api')->user();
        Auth::guard('api')->logout();
        return new LogoutResource($user);
    }

    public function roles()
    {
        $userId = auth()->user()->getAuthIdentifier();
        $roles = DB::table('role_user')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('role_user.user_id', '=', $userId)
            ->select('roles.role')
            ->get();

        return response()->json(['roles'=> $roles,
        'isAdmin' => User::query()->find($userId)->isAdmin()]);
    }
}
