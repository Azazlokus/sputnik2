<?php

namespace App\Models;

use Database\Factories\RatingFactory;
use Exception;
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($rating) {
            $user = auth()->user();
            if ($user && $user->ratings()->where('relax_place_id', $rating->relax_place_id)->exists()) {
                throw new Exception('This rating is already exist.', 409);
            }
            if ($user) {
                $rating->user_id = $user->id;
            }
        });
    }
}
