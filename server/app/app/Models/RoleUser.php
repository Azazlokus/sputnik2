<?php

namespace App\Models;

use App\Enums\NotificationTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot(): void
    {
        self::created(function (self $model) {
            $model->sendBlockNotifications();
        });

        self::deleted(function (self $model) {
            $model->sendUnblockNotifications();
        });
        parent::boot();
    }
    protected function sendBlockNotifications(): void
    {
        UserNotification::query()->create([
            'user_id' => $this->user_id,
            'type' => NotificationTypeEnum::Push,
            'content' => "User with id: $this->user_id, you have been blocked."
        ]);
    }

    protected function sendUnblockNotifications(): void
    {
        UserNotification::query()->create([
            'user_id' => $this->user_id,
            'type' => NotificationTypeEnum::Push,
            'content' => "User with id: $this->user_id, you have been unblocked."
        ]);
    }
}
