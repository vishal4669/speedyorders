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
        $option_data = Option::with('optionValues')->where('options.id', $request->optionId)->first();

        $counter = $request->counter;

        switch($option_data->type){
            case 'select' :                 
                $returnHTML .= view('adminproduct::htmlelement.select',compact('option_data','counter'))->render();
            break;

            case 'input' : 
                $returnHTML .= view('adminproduct::htmlelement.input',compact('option_data','counter'))->render();
            break;
        }       

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
