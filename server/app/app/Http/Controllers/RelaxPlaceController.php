<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelaxPlaceRequest;
use App\Http\Resources\RelaxPlaceResource;
use App\Models\RelaxPlace;
use Orion\Concerns\DisableAuthorization;
use  Orion\Http\Controllers\Controller;

class RelaxPlaceController extends Controller
{
    use DisableAuthorization;
    protected $model = RelaxPlace::class;
    protected $request = RelaxPlaceRequest::class;
    protected $resource = RelaxPlaceResource::class;

}
