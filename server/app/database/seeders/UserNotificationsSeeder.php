<?php

namespace database\seeders;

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
                'user_id' => '11111111-1111-1111-1111-111111111111',
                'type' => 'email',
                'content' => 'bla bla bla',
                'viewed' => false
            ],
            [
                'user_id' => '00000000-0000-0000-0000-000000000000',
                'type' => 'email',
                'content' => 'bla bla bla',
                'viewed' => true
            ]
        ]);
    }
}
