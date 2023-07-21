<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelaxPlaceImageRequest;
use App\Http\Resources\RelaxPlaceResource;
use App\Models\RelaxPlace;
use App\Models\RelaxPlaceImage;
use App\Policies\relaxPlacePolicy;
use Illuminate\Http\Request;

class RelaxPlaceImageController extends Controller
{
    protected $model = RelaxPlaceImage::class;
    protected $request = RelaxPlaceImageRequest::class;
    protected $resource = RelaxPlaceResource::class;
    protected $policy = RelaxPlacePolicy::class;
}
