<?php

namespace App\Models;

use Database\Factories\RatingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'relax_place_id',
        'rating',
        'comment'
    ];
    protected static function newFactory(): RatingFactory
    {
        return RatingFactory::new();
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($rating) {
            $user = auth()->user();
            if ($user) {
                $rating->user_id = $user->id;
            }
        });
    }
}
