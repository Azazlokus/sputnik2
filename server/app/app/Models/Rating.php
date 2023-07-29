<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'relax_place_id',
        'rating',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function relaxPlace()
    {
        return $this->belongsTo(RelaxPlace::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function (self $model) {
            $model->cancelIfAlreadyExist();
            $model->cancelIfWasntFavorite();
        });
    }

    /**
     * @throws Exception
     */
    public function cancelIfWasntFavorite()
    {
        if (
            UserWishlist::query()->where('user_id', $this->user_id)
                ->where('relax_place_id', $this->relax_place_id)->doesntExist()
        ) {
            throw new Exception('Error: this place isn\'t favorite', Response::HTTP_ALREADY_REPORTED);
        }
    }

    public function cancelIfAlreadyExist()
    {
        $user = auth()->user();
        if ($user && $user->ratings()->where('relax_place_id', $this->relaxPlace()->pluck('id'))->exists()) {
            throw new Exception('This rating is already exist.', Response::HTTP_BAD_GATEWAY);
        }
        if ($user) {
            $this->user_id = $user->id;
        }
    }

}
