<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelaxPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'latitude',
        'longitude',
        'average_rating',
        'country',
        'category'
    ];

    public function wishlists()
    {
        return $this->hasMany(UserWishlist::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (self $model) {
            $model->sendNotifications();
        });

    }
    public function sendNotifications(): void
    {
        $usersId = $this->wishlists->pluck('user_id');
        foreach ($usersId as $userId) {
            UserNotification::query()->create([
                'user_id' => $userId,
                'type' => 'push',
                'content' => 'User with id: '. $userId . ' your place from wishlist has been deleted'
            ]);
        }
    }
}

