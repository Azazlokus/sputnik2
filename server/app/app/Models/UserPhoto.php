<?php

namespace App\Models;

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

        static::creating(function ($userPhoto) {
            $user = auth()->user();
            if ($user) { // А если null/false?
                $userPhoto->user_id = $user->id;
            }
        });
    }
}
