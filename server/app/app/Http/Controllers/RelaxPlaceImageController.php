<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelaxPlaceImageRequest;
use App\Http\Resources\RelaxPlaceImageResource;

use App\Models\RelaxPlaceImage;
use App\Policies\relaxPlacePolicy;
use Orion\Http\Controllers\Controller;


class RelaxPlaceImageController extends Controller
{
    protected $model = RelaxPlaceImage::class;
    protected $request = RelaxPlaceImageRequest::class;
    protected $resource = RelaxPlaceImageResource::class;
    protected $policy = RelaxPlacePolicy::class;
}
