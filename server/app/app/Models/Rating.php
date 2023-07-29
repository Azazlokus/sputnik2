<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function relaxPlace(): BelongsTo
    {
        return $this->belongsTo(RelaxPlace::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function (self $model) {
            $model->cancelIfAlreadyExist();
            $model->setUserId();
            $model->cancelIfWasntFavorite();

            self::created(function (self $model) {
                $model->calculateAverageRating();
            });

            self::updated(function (self $model) {
                $model->calculateAverageRating();
            });

            self::deleted(function (self $model) {
                $model->calculateAverageRating();
            });

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

    protected function cancelIfAlreadyExist()
    {
        $user = auth()->user();
        if ($user && $user->ratings()->where('relax_place_id', $this->relaxPlace()->pluck('id'))->exists()) {
            throw new Exception('This rating is already exist.', Response::HTTP_BAD_GATEWAY);
        }
    }
    protected function setUserId()
    {
        $user = auth()->user();
        if ($user) {
            $this->user_id = $user->id;
        }
    }

    private function calculateAverageRating()
    {
        $relaxPlace = $this->relaxPlace;
        $relaxPlace->average_rating = self::where('relax_place_id', $this->relax_place_id)->avg('rating');
        $relaxPlace->save();
    }

}
