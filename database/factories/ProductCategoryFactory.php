<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Category;
use Faker\Generator as Faker;
use App\Models\ProductCategory;

$factory->define(ProductCategory::class, function (Faker $faker) {
    $categoryIds = Category::all()->pluck('id');

    return [
        'category_id'=>$faker->randomElement($categoryIds),
        'status'=>$faker->numberBetween(0,1),
    ];
});
