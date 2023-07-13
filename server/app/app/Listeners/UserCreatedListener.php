<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
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
        $adminRoleId = Role::where('name', 'Администратор')->value('id');

        $admins = User::whereHas('roles', function ($query) use ($adminRoleId) {
            $query->where('role_id', $adminRoleId);
        })->get();

        foreach ($admins as $admin) {
            $admin->notify(new UserCreatedNotification($event->user));
        }
    }

    /**
     * Handle the event.
     */

}
