<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingZonePrice extends Model
{
    protected $guarded = [''];

    protected $table = 'shipping_zone_prices';

    function deliverytime(){
    	return $this->belongsTo('App\Models\ShippingDeliveryTime', 'shipping_delivery_times_id');
    }

    function group(){
        return $this->belongsTo('App\Models\ShippingZoneGroup', 'shipping_zone_groups_id');
    }

    function package(){
    	return $this->belongsTo('App\Models\ShippingPackage', 'shipping_packages_id');
    }
}
