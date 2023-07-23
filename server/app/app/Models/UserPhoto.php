<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image_name',
        'path_to_photo',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $userPhoto) {
            $this->checkUserPhotoExist();
        });
    }

    private function checkUserPhotoExist($userPhoto)
    {
        $user = auth()->user();
        if ($user) {
            $userPhoto->user_id = $user->id;
        }
    }
}
