<?php

namespace App\Models;

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

    public function relaxPlace()
    {
        return $this->belongsTo(RelaxPlace::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function (self $model) {
            $model->cancelIfAlreadyExist(); // Я будто на свой код гляжу :)
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
            throw new Exception('Error: this place isn\' favorite', 500); // про исключения я уже писал
        }
    }

    public function cancelIfAlreadyExist()
    {
        $user = auth()->user();//ниже происходит что-то страшное
        // зачем получать ratings из пользователя, если мы и так находимся в сущности Rating
        if ($user && $user->ratings()->where('relax_place_id', $this->relaxPlace()->pluck('id'))->exists()) {
            throw new Exception('This rating is already exist.', 409);
        }
        if ($user) {
            $this->user_id = $user->id; // зачем это тут, как это соотносится с названием метода?
        }
    }

}
