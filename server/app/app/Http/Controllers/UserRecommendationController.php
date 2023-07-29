<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRecommendationRequest;
use App\Http\Resources\UserRecommendationResource;
use App\Models\UserRecommendation;
use App\Policies\UserRecommendationPolicy;
use App\Traits\AggregateQueryForUserRole;
use Illuminate\Database\Eloquent\Builder;
use Orion\Http\Controllers\Controller;

class UserRecommendationController extends Controller
{
    use AggregateQueryForUserRole;

    protected $model = UserRecommendation::class;
    protected $request = UserRecommendationRequest::class;
    protected $resource = UserRecommendationResource::class;
    protected $policy = UserRecommendationPolicy::class;
    protected function buildIndexFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->changeQueryForUser($query);
        return $query;
    }

}
