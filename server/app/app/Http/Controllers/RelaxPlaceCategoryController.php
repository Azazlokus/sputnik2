<?php

namespace app\Http\Controllers;

use App\Http\Requests\RelaxPlaceCategoryRequest;
use App\Http\Resources\RelaxPlaceCategoryResource;
use App\Models\RelaxPlaceCategory;
use App\Policies\RelaxPlaceCategoryPolicy;
use Orion\Http\Controllers\Controller;

class RelaxPlaceCategoryController extends Controller
{
    protected $request = RelaxPlaceCategoryRequest::class;
    protected $model = RelaxPlaceCategory::class;
    protected $resource = RelaxPlaceCategoryResource::class;
    protected $policy = RelaxPlaceCategoryPolicy::class;
}
