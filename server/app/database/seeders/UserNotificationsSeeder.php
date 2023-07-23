<?php

namespace database\seeders;

use App\Constants\NotificationTypeConstants;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserNotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_notifications')->insert([
            [
                'user_id' => User::query()->inRandomOrder()->pluck('id')->first(),
                'type' => NotificationTypeConstants::MAIL,
                'content' => 'User has been registered',
                'viewed' => false
            ],
            [
                'user_id' => User::query()->inRandomOrder()->pluck('id')->first(),
                'type' => NotificationTypeConstants::PUSH,
                'content' => 'User has been registered',
                'viewed' => true
            ]
        ]);
    }
}
