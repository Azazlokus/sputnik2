<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPhotoRequest;
use App\Http\Resources\UserPhotoResource;
use App\Models\UserPhoto;
use App\Policies\UserPhotoPolicy;
use App\Traits\IfUserThenSelectsQuery;
use Illuminate\Database\Eloquent\Builder;
use Orion\Http\Controllers\Controller;

class UserPhotoController extends Controller
{
    use IfUserThenSelectsQuery;
    protected $model = UserPhoto::class;
    protected $request = UserPhotoRequest::class;
    protected $resource = UserPhotoResource::class;
    protected $policy = UserPhotoPolicy::class;

    protected function buildIndexFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->ifUserChangeQuery($query);
        return $query;
    }

}
