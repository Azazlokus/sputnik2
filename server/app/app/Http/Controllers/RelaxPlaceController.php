<?php

namespace App\Http\Controllers;

use App\Models\RelaxPlace;
use Orion\Concerns\DisableAuthorization;
use  Orion\Http\Controllers\Controller;

class RelaxPlaceController extends Controller
{
    //use DisableAuthorization;
    protected $model = RelaxPlace::class;

}
