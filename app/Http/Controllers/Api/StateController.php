<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App;
class StateController extends  BaseController
{
    //
    public function index()
    {
        $l_name = App::getLocale() == 'ar' ? 'name' : 'name_fr';
        $region = 'regions.'.$l_name.' as region';
        $city = 'cities.'.$l_name.' as city';
        $state = 'states.'.$l_name.' as state';
        $regions = City::join('states','states.id','cities.state_id')->join('regions','regions.city_id','cities.id')->select($region , $city , $state)->get();

        return $this->sendResponse($regions, __("auth.success"));
    }
}
