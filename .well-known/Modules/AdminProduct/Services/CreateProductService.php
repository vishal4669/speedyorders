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

class CreateProductService
{
    public function handleGeneralInformation(array $validatedData)
    {
        try {
            DB::beginTransaction();

            if (isset($validatedData['image'])) {
                $image = $validatedData['image'];
                $imageName =
                    uniqid() .
                    time() .
                    '.' .
                    $image->getClientOriginalExtension();
                $image->move(public_path('images/products'), $imageName);
                $validatedData['image'] = $imageName;
            }

            $product = Product::create($validatedData);

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
            
            if (isset($validatedData['categories'])) {
                /**SAVING PRODUCT CATEGORIES RELATIONSHIP */
                $insertData = [];
                $time = now();
                foreach ($validatedData['categories'] as $categroy) {
                    $insertData[] = [
                        'category_id' => $categroy,
                        'product_id' => $product->id,
                        'status' => 1,
                        'created_at' => $time,
                        'updated_at' => $time,
                    ];
                }

                ProductCategory::insert($insertData);
            }

            /**HANDLING OPTIONS */
            if (
                isset($validatedData['option']) &&
                count($validatedData['option']) > 0
            ) {
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
                                            ],
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

            DB::commit();
            return true;
        } catch (\Exception $e) {
            //TODO:
            /**REMOVE IMAGE FROM FOLDER */
            dd($e);
            DB::rollback();
            return false;
        }
    }
}
