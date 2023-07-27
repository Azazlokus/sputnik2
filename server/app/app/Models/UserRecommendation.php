<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRecommendation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'relax_place_id'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
