<?php

namespace App\Models;

use App\Models\ShippingZoneGroup;

use Illuminate\Database\Eloquent\Model;

    class ProductGroup extends Model
{

    
    protected $fillable = [
        'id',
        'product_id',
        'group_id'
    ];


    public function group(){
        return $this->belongsTo(ShippingZoneGroup::class,'group_id');
    }


}
