<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\RelaxPlaceCategory;
use App\Policies\CategoryPolicy;
use Orion\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $request = CategoryRequest::class;
    protected $model = RelaxPlaceCategory::class;
    protected $resource = CategoryResource::class;
    protected $policy = CategoryPolicy::class;
}
