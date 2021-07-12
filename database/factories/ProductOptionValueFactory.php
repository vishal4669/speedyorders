<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Option;
use App\Models\OptionValue;
use App\Models\ProductOption;
use Faker\Generator as Faker;
use App\Models\ProductOptionValue;

$factory->define(ProductOptionValue::class, function (Faker $faker) {
    $optionId = ProductOption::latest()->first();
    
    $optionValueIds = OptionValue::where('option_id',$optionId->option_id)->get()->pluck('id')->toArray();

    return [
        'option_id'=>$optionId->option_id,
        'option_value_id'=>$faker->randomElement($optionValueIds),
        'quantity'=>$faker->numberBetween(10,110),
        'subtract_from_stock'=>$faker->boolean(100),
        'price'=>$faker->randomFloat(2,22,122),
        'price_prefix'=>$faker->boolean(50),
        'status'=>$faker->boolean(100)
    ];
});
