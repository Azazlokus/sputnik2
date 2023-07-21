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
}
