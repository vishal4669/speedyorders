<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;
use App\Models\ProductRelatedProduct;

$factory->define(ProductRelatedProduct::class, function (Faker $faker) {
    $productIds = Product::inRandomOrder()->limit(5)->get()->pluck('id');
    return [
        'related_product_id'=>$faker->randomElement($productIds)
    ];
});
