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
        static::creating(function (self $wishlist) {
            $wishlist->checkIfWishlistAlreadyExist($wishlist);
        });
        static::created(function (self $wishlist) {
            $wishlist->addRecommendationByCountry($wishlist);
        });

    }

    private function checkIfWishlistAlreadyExist($wishlist)
    {
        $user = auth()->user();
        if ($user && $user->wishlists()->where('relax_place_id', $wishlist->relax_place_id)->exists()) {
            throw new Exception('This place is already in the user\'s wishlist.', 409);
        }
        if ($user) {
            $wishlist->user_id = $user->id;
        }
    }

    private function addRecommendationByCountry($wishlist)
    {

        /*   = self::query()
              ->relaxPlaces
              ->where('country', $this->country)
              ->with('usersFavorite')
              ->get();*/

        $country = $this->relaxPlaces->pluck('country');
        $recommendations = RelaxPlace::query()->where('country', $country)->pluck('id');
        if ($recommendations) {
            foreach ($recommendations as $recommendation) {
                UserRecommendation::query()->create(
                    [
                        'user_id' => auth()->user()->getAuthIdentifier(),
                        'relax_place_id' => $recommendation
                    ]
                );
            }
        }
    }
}
