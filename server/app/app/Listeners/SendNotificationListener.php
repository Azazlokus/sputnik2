<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Models\UserNotification;
use App\Models\Role;
use App\Models\User;
use App\Components\UserCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
class SendNotificationListener
{
    /**
     * Create the event listener.
     */
    public function handle(UserCreatedEvent $event)
    {
        $adminRoleId = Role::query()->where('role', \App\Constants\Role::ADMIN)->value('id');

        $admins = User::query()->whereHas('roles', function ($query) use ($adminRoleId) {
            $query->where('role_id', $adminRoleId);
        })->get();

        foreach ($admins as $admin) {
            UserNotification::query()->create([
                'user_id' => $admin->getKey(),
                'type' => 'push',
                'content' => 'User has been registered'
            ]);
        }
    }
}
