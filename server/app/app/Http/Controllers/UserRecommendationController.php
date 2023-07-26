<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRecommendationRequest;
use App\Http\Resources\UserRecommendationResource;
use App\Models\UserRecommendation;
use App\Policies\UserRecommendationPolicy;
use Illuminate\Http\Request;

class UserRecommendationController extends Controller
{
    protected $model = UserRecommendation::class;
    protected $request = UserRecommendationRequest::class;
    protected $resource = UserRecommendationResource::class;
    protected $policy = UserRecommendationPolicy::class;
}
