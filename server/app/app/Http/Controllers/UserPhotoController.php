<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPhotoRequest;
use App\Http\Resources\UserPhotoResource;
use App\Models\User;
use App\Models\UserPhoto;
use App\Policies\UserPhotoPolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;

class UserPhotoController extends Controller
{
    protected $model = UserPhoto::class;
    protected $request = UserPhotoRequest::class;
    protected $resource = UserPhotoResource::class;
    protected $policy = UserPhotoPolicy::class;

    protected function buildFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildFetchQuery($request, $requestedRelations);
        $this->ifUserChangeQuery($query);
        return $query;
    }

    protected function ifUserChangeQuery($query): void
    {
        $user = User::query()->find($this->getUserID());
        if ($user->isUser()) {
            $query->where('user_id', $user->id);
        }
    }
    protected function getUserID()
    {
        return Auth::user()->getAuthIdentifier();
    }
}
