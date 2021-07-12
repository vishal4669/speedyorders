<?php

namespace Modules\AdminApi\Http\Controllers\v1;

use App\State;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AdminApi\Http\Controllers\BaseController;

class StateController extends BaseController
{
    public function getCountryState($country_id)
    {
        $states = State::where('country_name',$country_id)->get();
        return $this->success($states);
    }

}
