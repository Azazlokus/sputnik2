<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRecommendationRequest;
use App\Http\Resources\UserRecommendationResource;
use App\Models\User;
use App\Models\UserRecommendation;
use App\Policies\UserRecommendationPolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;

class UserRecommendationController extends Controller
{
    protected $model = UserRecommendation::class;
    protected $request = UserRecommendationRequest::class;
    protected $resource = UserRecommendationResource::class;
    protected $policy = UserRecommendationPolicy::class;

    protected function buildFetchQuery( $request, array $requestedRelations): Builder
    {
        $query = parent::buildFetchQuery($request, $requestedRelations);
        $this->ifUserChangeQuery($query);
        return $query;
    }
    protected  function ifUserChangeQuery($query): void // Что вообще значит ifUserChange? Название не очень ясное
    {
        $user = User::query()->find($this->getUserId());
        if($user->isUser()) {
            $query->where('user_id', $user->id);
        }
    }
    protected function getUserId(){
        return Auth::user()->getAuthIdentifier();
    }
}
