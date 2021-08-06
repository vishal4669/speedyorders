<?php
namespace Modules\AdminProduct\Services;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use App\Models\ProductRelatedProduct;
use App\Models\ProductGroup;
use Illuminate\Support\Facades\DB;
use Log;

class ImportProductService
{

    public function handle(array $validatedData)
    {
        try
        {

            DB::beginTransaction();

            $fileName = '';
            if (isset($validatedData['file_name'])) {
                $file_name = $validatedData['file_name'];
                $fileName =
                    uniqid() .
                    time() .
                    '.' .
                    $file_name->getClientOriginalExtension();
                $file_name->move(public_path('images/products'), $fileName);
                $validatedData['file_name'] = $fileName;
            }

            // Now parse the csv and store all values in DB
            $filename = public_path('images/products/'.$fileName);
            $file = fopen($filename, "r");
            $all_data = array();

            $count_header = 0;

            while ( ($data = fgetcsv($file, 500, ",")) !==FALSE ) {

                if($count_header > 0){

                    $product_name = $data[0];
                    $product_description = $data[1];
                    $meta_title = $data[2];
                    $meta_description = $data[3];
                    $meta_keywords = $data[4];
                    $sku = $data[5];
                    $product_height = $data[6];
                    $product_width = $data[7];
                    $product_length = $data[8];
                    $base_price = $data[9];
                    $sale_price = $data[10];
                    $product_qty = $data[11];
                    $public_status = $data[12];
                    $is_featured = $data[13];
                    $return_policy_days = $data[14];

                    $category_ids = explode(',', $data[15]);
                    $related_products = explode(',', $data[16]);
                    $options = explode(',', $data[17]);


                    // check if product already exists
                    $product_Data = Product::where('name', $product_name)->first();
                    if(!empty($product_Data)){
                        $product_id = $product_Data["id"];
                    } else{
                        $product = new Product();
                        $product->sku = $sku;
                        $product->name = $product_name;
                        $product->length = $product_length;
                        $product->height = $product_height;
                        $product->width = $product_width;
                        $product->description = $product_description;
                        $product->base_price = $base_price;
                        $product->sale_price = $sale_price;
                        $product->quantity = $product_qty;
                        $product->is_featured = ($is_featured=="Yes") ? 1 : 0;
                        $product->status = ($public_status=="Yes") ? 1 : 0;
                        $product->meta_title = $meta_title;
                        $product->meta_description = $meta_description;
                        $product->meta_keywords = $meta_keywords;
                        $product->return_policy_days = $return_policy_days;
                        $product->created_at = now();
                        $product->save();

                        $product_id = $product->id;
                    }

                    if(!empty($category_ids)){
                        foreach($category_ids as $category_id){
                            $product_category_Data = ProductCategory::where('product_id', $product_id)->where('category_id', $category_id)->first();
                            if(empty($product_category_Data)){
                                $productCategory = new ProductCategory();
                                $productCategory->product_id = $product_id;
                                $productCategory->category_id = $category_id;
                                $productCategory->save();
                            } 
                        }
                    }       

                    if(!empty($related_products)){
                        foreach($related_products as $related_product_id){
                            $related_product_Data = ProductRelatedProduct::where('product_id', $product_id)->where('related_product_id', $related_product_id)->first();
                            if(empty($related_product_Data)){
                                $relatedProductData = new ProductRelatedProduct();
                                $relatedProductData->product_id = $product_id;
                                $relatedProductData->related_product_id = $related_product_id;
                                $relatedProductData->save();
                            } 
                        }
                    }         

                    if(!empty($options)){
                        foreach($options as $option){
                            
                        }
                    }         

                }

                $count_header++;                            

            }

            DB::commit();
            return true;
        }
        catch(\Exception $e)
        {
            Log::info('Error'.$e->getMessage());
           // DB::rollback();
           return false;
        }
    }

}
