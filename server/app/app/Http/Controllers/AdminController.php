<?php

namespace App\Http\Controllers;

use App\Constants\RoleConstants;
use App\Http\Requests\UserIdRequest;
use App\Http\Resources\BlockResource;
use App\Http\Resources\UnblockResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function blockUser(User $user)
    {
        $role = Role::query()->where('role', RoleConstants::USER_BLOCKED)->first();
        $user->roles()->attach($role);
        $user->save();
        return new BlockResource($user);
    }

    public function unblockUser(User $user)
    {
        $role = Role::query()->where('role', RoleConstants::USER_BLOCKED)->first();
        $user->roles()->detach($role);
        $user->save();
        return new UnblockResource($user);
    }
    public function wishlist(User $user)
    {
        $wishlists = $user->wishlists;
        return response()->json(['places'=>$wishlists]);
    }
}
