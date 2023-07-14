<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Models\UserNotification;
use App\Models\Role;
use App\Models\User;
use App\Notifications\UserCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserCreatedListener
{
    /**
     * Create the event listener.
     */
    public function handle(UserCreatedEvent $event)
    {
        $adminRoleId = Role::where('role', 'Администратор')->value('id');

        $admins = User::whereHas('roles', function ($query) use ($adminRoleId) {
            $query->where('role_id', $adminRoleId);
        })->get();

        foreach ($admins as $admin) {
            UserNotification::create([
                'user_id' => $admin->getKey(),
                'type' => 'push',
                'content' => 'Hello, Davakin...',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Handle the event.
     */

}
