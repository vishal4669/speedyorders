<?php

namespace Modules\AdminApi\Http\Controllers\v1\customer;

use App\Models\CustomerCompareProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AdminApi\Http\Controllers\BaseController;
use Modules\AdminApi\Services\AddToCompareService;

class CompareProductController extends BaseController
{
    public function addToCompareList(Request $request, AddToCompareService $service){
        
        return $service->handle($request);
        
    }

    public function getCustomerComparelist(){
            $customer_id = request()->user()->id;
            $customerCompareProduct = CustomerCompareProduct::where('customer_id', $customer_id)->with('customerCompareProductOption')->get();
            $res =[];
            if($customerCompareProduct)
            {
                foreach($customerCompareProduct as $w_product){
                 
                    $product['product_name'] = $w_product->product->name ;
                    $options = array();
                    if($w_product->customerCompareProductOption)
                    {

                       
                        foreach($w_product->customerCompareProductOption as $option)
                        {
                            
                            $optionList['option'] = $option->productOption->option->name;
                            $optionList['option_type'] = $option->productOption->option->type;
                            $optionList['option_value'] = ($option->productOption->option->type == 'select')?$option->productOptionValue->optionValue->name:$option->product_option_value;
                            $options[] = $optionList;
                        }

                        $product['options'] = $options;

                        $res[] = $product;
                    }

                    
                   
                }
            } 
            
                
               return $this->success($res);



    }
}
