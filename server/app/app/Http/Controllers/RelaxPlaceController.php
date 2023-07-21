<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelaxPlaceImageRequest;
use App\Http\Resources\RelaxPlaceResource;
use App\Models\RelaxPlace;
use App\Policies\relaxPlacePolicy;
use  Orion\Http\Controllers\Controller;

class RelaxPlaceController extends Controller
{
    protected $model = RelaxPlace::class;
    protected $request = RelaxPlaceImageRequest::class;
    protected $resource = RelaxPlaceResource::class;
    protected $policy = RelaxPlacePolicy::class;


}
