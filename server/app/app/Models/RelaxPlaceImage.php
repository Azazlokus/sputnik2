<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelaxPlaceImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'relax_place_id',
        'image_name',
        'path_to_image',

    ];
}
