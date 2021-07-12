<?php
namespace Modules\AdminApi\Services;


use App\Models\Product;
use App\Models\CustomerCompareProduct;
use App\Models\ProductOption;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerCompareProductOption;

class AddToCompareService
{
    
    public function handle($request)
    {
       $customer_id = $request->user()->id;
        $options = [];
        $optionsLength = 0;
        
        
        if(isset($request->options) && count($request->options)>0){
            foreach($request->options as $option_id => $option_value){
                
                $product_option = ProductOption::where('id', $option_id)->first();
                
                $product_option_type = $product_option->option->type;
                
                if($product_option_type == "select")
                {
                    $options[$option_id] = $option_value;
                }
            }
            
            $optionsLength = count($options);
            
            
        }
        
        
        
        
        if($this->checkProductAlredyExistInComparelist($request,$customer_id, $options, $optionsLength))
        {
            return response()->json([
                "status"=>200,
                "msg"   => "Product Already Exist In Your Compare List !"
            ]);
        }
        else{
            
            try{
                DB::beginTransaction();
                
                $product = Product::where('status','1')->where('id',$request->product_id)->with('options')->first();
                
                if($product)
                {
                    $compareProduct = CustomerCompareProduct::create([
                        "customer_id" => $customer_id,
                        "product_id" => $product->id
                        ]);
                        
                        if(isset($request->options) && count($request->options)>0)
                        {
                            
                            foreach($request->options as $option_id => $option_value){
                                
                                $product_option = ProductOption::where('id', $option_id)->first();
                                
                                $product_option_type = $product_option->option->type;
                                
                                
                                
                                CustomerCompareProductOption::create([
                                    'customer_compare_product_id' => $compareProduct->id,
                                    'product_option_id'           => $option_id,
                                    'product_option_value_id'     => ($product_option_type == 'select') ? $option_value:null,
                                    'product_option_value'        => ($product_option_type == 'select') ? null:$option_value,
                                    
                                    ]);
                                    
                                }
                                
                                
                            }
                            DB::commit();
                            return response()->json([
                                "status"=>200,
                                "msg"   => "Product Added To Your Compare List !"
                            ]);
                        }
                        
                        return response()->json([
                            "status"=>200,
                            "msg"   => "Product Not Found !"
                        ]);
                        
                        
                    }
                    catch (\Exception $e) {
                        dd($e);
                        DB::rollback();
                        return response()->json([
                            "status"=>200,
                            "msg"   => "Something Went Wrong !"
                        ]);
                    }
                    
                    
                }
                
                
            }
            
            private function checkProductAlredyExistInComparelist($request,$customer_id,$options, $optionsLength)  
            {
                $isExist = false;
                $newProduct = $request->product_id;
               
                $newOptions = $request->options ??[];
                $productExist = CustomerCompareProduct::where('customer_id', $customer_id )->where('product_id',$newProduct)->with('customerCompareProductOption')->get();
            
                if(count($newOptions)>0)
                {
                    foreach($productExist as $p_exist)
                    {   
                        $oldCompareProductOption = [];
                        
                        if($p_exist->customerCompareProductOption)
                        {
                          
                            foreach($p_exist->customerCompareProductOption as $oldOption){
                                
                                
                                if($oldOption->productOption->option->type == "select")
                                {
                                    $oldCompareProductOption[$oldOption->product_option_id] = $oldOption->product_option_value_id;
                                }
                            }
                        }
                     
                        if(count(array_intersect($options, $oldCompareProductOption)) == $optionsLength)
                        {
                            $isExist = true;
                            
                        }
                        
                    }
                    
                }
                else{
                   
                    
                    if(count($productExist)>0)
                    {
                        $isExist = true;
                    }
                    
                }
          
                
                return $isExist;
            }
            
            
        }
