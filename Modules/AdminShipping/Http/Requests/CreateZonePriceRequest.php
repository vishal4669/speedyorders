<?php

namespace Modules\AdminShipping\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Log;

class CreateZonePriceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {

       if($request->type==1){
            return [
                'type' => "required",
                'group_name' => "required",
                'zip_code' => "required",
                'price' => "required",
                'shipping_delivery_times_id' => "required",
                'shipping_packages_id' => "required|integer",
            ];
       } else {
            return [
                'type' => "required",
                'file_name' => "required"
            ];
       }        
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
