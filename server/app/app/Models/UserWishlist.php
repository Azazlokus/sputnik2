<?php

namespace App\Models;

use App\Constants\RoleConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWishlist extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'relax_place_id',
        'visit_time'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($wishlist) {
          $user = auth()->user();
            if ($user) {
                $wishlist->user_id = $user->id;
            }
        });
    }

}
