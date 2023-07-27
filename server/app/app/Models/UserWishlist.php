<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWishlist extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'relax_place_id',
        'visit_time'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function relaxPlaces(): BelongsTo
    {
        return $this->belongsTo(RelaxPlace::class);
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (self $model) {
            $model->checkIfWishlistAlreadyExist();
        });
        static::created(function (self $model) {
            $model->addRecommendationByCountry();
        });

    }

    private function checkIfWishlistAlreadyExist()
    {
        $user = auth()->user();
        if ($user && $user->wishlists()->where('relax_place_id', $this->relax_place_id)->exists()) {
            throw new Exception('This place is already in the user\'s wishlist.', 409);
        }
        if ($user) {
            $this->user_id = $user->id;
        }
    }

    private function addRecommendationByCountry()
    {
        $target_country = $this->relaxPlaces->pluck('country')->unique();
        $recommended_relax_place_id = RelaxPlace::query()
            ->where('country', $target_country)
            ->pluck('id');
        foreach ($recommended_relax_place_id as $relax_place_id) {
            UserRecommendation::query()
                ->create([
                    'user_id' => $this->user_id,
                    'relax_place_id' => $relax_place_id,
                ]);
        }
    }
}
