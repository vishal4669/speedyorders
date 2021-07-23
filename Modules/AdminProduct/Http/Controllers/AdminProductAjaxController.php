<?php

namespace Modules\AdminProduct\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\ShippingZonePrice;

class AdminProductAjaxController extends Controller
{

    public function option(Request $request){
        $returnHTML = '';
        if(!$request->optionId){
            return;
        }
        $options = Option::with('optionValues')->get();
        $counter = $request->counter;

        $colspan = count($options) +1;

        $returnHTML .= view('adminproduct::htmlelement.radio',compact('options','counter', 'colspan'))->render();
                

        return response()->json(array('success' => true, 'html'=>$returnHTML));     
    }

    public function group(Request $request){

        if(!$request->groupId){
            return;
        }
        $option = ShippingZonePrice::where('id',$request->groupId)->first();
        
        $returnHTML = view('adminproduct::htmlelement.input',compact('option','counter'))->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
      

    }


    public function optionValue(Request $request){

        if(!$request->optionId){
            return;
        }
        $option = Option::where('id',$request->optionId)->with('optionValues')->first();
        $counter = $request->counter;


        switch($option->type){

            // case "input":
            //     $returnHTML = view('adminproduct::htmlelement.input',compact('option','counter'))->render();
            //     return response()->json(array('success' => true, 'html'=>$returnHTML));
            //     break;
            case "select":
                $returnHTML = view('adminproduct::htmlelement.select-value',compact('option','counter'))->render();
                return response()->json(array('success' => true, 'html'=>$returnHTML));
                break;
        }
    }
}
