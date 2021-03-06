<?php


namespace Modules\AdminProduct\Services;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use App\Models\ProductRelatedProduct;
use App\Models\ProductGroup;
class UpdateProductService
{
    public function handle(array $validatedData,$id)
    {
        \DB::beginTransaction();

        try
        {

            $product = Product::find($id);

            if(isset($validatedData['image']))
            {
                $image = $validatedData['image'];
                $image_name = uniqid().time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/products'),$image_name);
                @unlink(public_path('images/products/'.$product->image));
                $validatedData['image'] = $image_name;
            }

            $product->update($validatedData);

            if (isset($validatedData['galleryId']))
            {
                $galleryId = rtrim($validatedData['galleryId'],',');

                $galleryId = explode(',',$galleryId);
                $productGallery = ProductGallery::whereIn('id',$galleryId)->get();
                /**SAVING PRODUCT IMAGES */
                foreach ($productGallery ?? [] as $key => $gallery)
                {
                    $gallery->update([
                        'product_id' => $product->id,
                    ]);
                }
            }

            if($validatedData['categories']){
                $product->categories()->delete();

                /**SAVING PRODUCT CATEGORIES RELATIONSHIP */
                $insertData = [];
                $time = now();
                foreach($validatedData['categories'] as $categroy){
                    $insertData[] = [
                        'category_id'=>$categroy,
                        'product_id'=>$product->id,
                        'status'=>1,
                        'created_at'=>$time,
                        'updated_at'=>$time
                    ];
                }

                ProductCategory::insert($insertData);

            }

            /**HANDLING OPTIONS */
            if (isset($validatedData['option']) && count($validatedData['option']) > 0) {
                $ids = $product->options->pluck('id');
                if(count($ids)>0){
                    ProductOption::where('id',$ids)->delete();
                }
                foreach ($validatedData['option'] as $optionKey => $option) {
                    switch ($optionKey) {
                        case 'input':
                            foreach ($option as $key => $optionValue) {
                                $productOption = ProductOption::create([
                                    'product_id' => $product->id,
                                    'option_id' => $key,
                                    'required' =>
                                        (bool) $validatedData[
                                            'option_required'
                                        ],
                                ]);

                                ProductOptionValue::create([
                                    'product_option_id' => $productOption->id,
                                    'option_id' => $key,
                                    'input_value' => $optionValue,
                                ]);
                            }
                            break;

                        case 'select':
                            foreach (
                                $option['option_values']
                                as $counter => $optionValue
                            ) {
                                $productOption = ProductOption::create([
                                    'product_id' => $product->id,
                                    'option_id' =>
                                        $validatedData['option_id'][$counter],
                                    'required' =>
                                        (bool) $validatedData[
                                            'option_required'
                                        ],
                                ]);

                                foreach ($optionValue as $vaueKey => $item) {
                                    ProductOptionValue::create([
                                        'product_option_id' =>
                                            $productOption->id,
                                        'option_id' =>
                                            $validatedData['option_id'][
                                                $counter
                                            ],
                                        'option_value_id' => $item,
                                        'quantity' =>
                                            $option['quantity'][$counter][
                                                $vaueKey
                                            ],
                                        'subtract_from_stock' =>
                                            $option['subtract_from_stock'][
                                                $counter
                                            ][$vaueKey],
                                        'price_prefix' =>
                                            $option['price_prefix'][$counter][
                                                $vaueKey
                                            ] == '+'
                                                ? 1
                                                : 0,
                                        'price' =>
                                            $option['price'][$counter][
                                                $vaueKey
                                            ],
                                    ]);
                                }
                            }
                            break;
                    }
                }
            }

            if(count($validatedData['related_products'])>0){
                if($product->related_products){
                    $product->related_products->delete();
                }
                $insertRelatedProductData = [];
                $time = now();
                foreach($validatedData['related_products'] as $rp){
                    $insertRelatedProductData[] =[
                        'product_id'=>$product->id,
                        'related_product_id'=>$rp,
                        'created_at' => $time,
                        'updated_at' => $time,
                    ];
                }

                ProductRelatedProduct::insert($insertRelatedProductData);
            }

            if(count($validatedData['groups'])>0){
                if($product->groups){
                    ProductGroup::where('product_id', $product->id)->delete();
;                }
                $insertGroupData = [];
                $time = now();
                foreach($validatedData['groups'] as $group){
                    $insertGroupData[] =[
                        'product_id'=>$product->id,
                        'group_id'=>$group
                    ];
                }

                ProductGroup::insert($insertGroupData);
            }

            \DB::commit();
            return true;
        }
        catch (\Exception $e)
        {
            dd($e);
            \DB::rollback();
            return false;
        }
    }
}
