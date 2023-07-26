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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function (self $model) {
            $model->cancelIfWasntFavorite();
            $model->cancelIfAlreadyExist();
        });
    }

    /**
     * @throws Exception
     */
    public function cancelIfWasntFavorite()
    {
        if (
            UserWishlist::query()
                ->where('user_id', $this->user_id)
                ->where('relax_place_id', $this->relax_place_id)
                ->doesntExist()
        ) {
            throw new Exception('Error', 500);
        }
    }
    public function cancelIfAlreadyExist(){
        $user = auth()->user();
        if ($user && $user->ratings()->where('relax_place_id', $this->relax_place_id)->exists()) {
            throw new Exception('This rating is already exist.', 409);
        }
        if ($user) {
            $this->rating->user_id = $user->id;
        }
    }

}
