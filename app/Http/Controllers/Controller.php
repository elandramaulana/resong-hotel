<?php

namespace App\Http\Controllers;

use App\Models\LatePointSetting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //load global variable here
    public function getExtrabedPrice()
    {
        $globalSetting = LatePointSetting::first();
        return $globalSetting->extrabed_price;
    }



}
