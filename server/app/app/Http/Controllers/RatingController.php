<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Http\Resources\RatingResource;
use App\Models\Rating;
use App\Policies\RatingPolicy;
use Orion\Http\Controllers\Controller;

class RatingController extends Controller
{
    protected $request = RatingRequest::class;
    protected $model = Rating::class;
    protected $resource = RatingResource::class;
    protected $policy = RatingPolicy::class;

}
