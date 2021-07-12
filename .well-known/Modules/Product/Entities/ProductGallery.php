<?php

namespace Modules\Product\Entities;

use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $fillable = [
        'image',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
