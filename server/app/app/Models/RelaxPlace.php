<?php

namespace App\Models;

use App\Enums\NotificationTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'category_id'
    ];

    public function wishlists(): HasMany
    {
        return $this->hasMany(UserWishlist::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
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
                'type' => NotificationTypeEnum::Push,
                'content' => "User, your place from wishlist has been deleted."
            ]);
        }
    }
}

