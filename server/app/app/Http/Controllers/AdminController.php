<?php

namespace App\Http\Controllers;

use App\Constants\RoleConstants;
use App\Http\Resources\BlockResource;
use App\Http\Resources\UnblockResource;
use App\Models\Role;
use App\Models\User;
use App\Models\UserNotification;
use Exception;


class AdminController extends Controller
{
    public function blockUser(User $user)
    {
        if(!$user->hasRole(RoleConstants::USER_BLOCKED)) {
            $role = Role::query()->where('role', RoleConstants::USER_BLOCKED)->first();
            $user->roles()->attach($role);
            $userId = $user->id;
            $user->save();
            $this->sendBlockNotifications($userId);

            return new BlockResource($user);
        }
        throw new Exception("User already has been blocked", 402);

    }

    public function unblockUser(User $user)
    {
        if($user->hasRole(RoleConstants::USER_BLOCKED)) {
            $role = Role::query()->where('role', RoleConstants::USER_BLOCKED)->first();
            $user->roles()->detach($role);
            $userId = $user->id;
            $user->save();
            $this->sendUnblockNotifications($userId);

            return new UnblockResource($user);
        }
        throw new Exception("User already has been unblocked", 402);
    }
    public function sendBlockNotifications($userId)
    {
        UserNotification::query()->create([
            'user_id' => $userId,
            'type' => 'push',
            'content' => 'User with id: ' . $userId . ', you have been blocked.'
        ]);
    }
    public function sendUnblockNotifications($userId)
    {
            UserNotification::query()->create([
                'user_id' => $userId,
                'type' => 'push',
                'content' => 'User with id: ' . $userId . ', you have been unblocked.'
            ]);
    }
}
