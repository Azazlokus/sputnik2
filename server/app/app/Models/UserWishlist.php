<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function relaxPlace(): BelongsTo
    {
        return $this->belongsTo(RelaxPlace::class);
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (self $model) {
            $model->checkIfWishlistAlreadyExist();
            $model->addRecommendationByCountry();
        });

    }

    private function checkIfWishlistAlreadyExist(): void
    {
        $user = auth()->user();
        //не очень понятно, зачем здесь проверять user'а, это по идее в политике нужно делать
        if ($user && $user->wishlists()->where('relax_place_id', $this->relaxPlace()->pluck('id'))->exists()) {
            throw new Exception('This place is already in the user\'s wishlist.', 409);
        }
        if ($user) {
            $this->user_id = $user->id;
        }
    }

    private function addRecommendationByCountry()
    {
        $target_country = $this->relaxPlace()->pluck('country');
        $recommended_relax_place_id = RelaxPlace::query()
            ->where('country', $target_country)
            ->pluck('id');
        $userId = auth()->user()->getAuthIdentifier();
        // Ну очень уж громоздко по вложенности получилось, я бы переделал
        if (!$recommended_relax_place_id->isEmpty()) {
            foreach ($recommended_relax_place_id as $relax_place_id) {
                if (UserRecommendation::query()
                    ->where('user_id', $userId)
                    ->where('relax_place_id', $relax_place_id)
                    ->doesntExist()) {
                    UserRecommendation::query()
                        ->create([
                            'user_id' => $this->user_id,
                            'relax_place_id' => $relax_place_id,
                        ]);
                }
            }
        }
    }
}
