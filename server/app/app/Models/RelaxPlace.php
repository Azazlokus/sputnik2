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

        static::deleting(function ($relaxPlace) {
            $usersId = $relaxPlace->wishlists->pluck('user_id');
            $relaxPlace->sendNotifications($usersId);
        });

    }
    public function sendNotifications($usersId)
    {
        foreach ($usersId as $userId) {
            UserNotification::query()->create([
                'user_id' => $userId,
                'type' => 'push',
                'content' => 'User '. $userId . 'your place from wishlist has been deleted'
            ]);
        }
    }
}

