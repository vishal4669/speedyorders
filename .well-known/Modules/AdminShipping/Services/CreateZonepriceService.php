<?php
namespace Modules\AdminShipping\Services;

use App\Models\ShippingZonePrice;
use App\Models\ShippingPackage;
use App\Models\ShippingDeliveryTime;
use App\Models\ShippingZoneGroup;
use Illuminate\Support\Facades\DB;
use Log;

class CreateZonepriceService
{

    public function handle(array $validatedData)
    {
        try
        {

            DB::beginTransaction();

            $type = $validatedData["type"];

            $zonetimes = (isset($validatedData["shipping_delivery_times_id"])) ? $validatedData["shipping_delivery_times_id"] : array();
            $zonetimesprice = (isset($validatedData["price"])) ? $validatedData["price"] : array();

            switch ($type) {
                case '1':

                        $zoneGroup = new ShippingZoneGroup();
                        $zoneGroup->group_name = $validatedData["group_name"];
                        $zoneGroup->save();

                        $zipcode_data = explode(',',$validatedData["zip_code"]);
                        $zip_counts = count($zipcode_data);

                        if($zip_counts > 1){
                            foreach($zipcode_data as $zipcode) {
                                
                                $price_data["zip_code"] = $zipcode;
                                $price_data["shipping_zone_groups_id"] = $zoneGroup->id;

                                for($i=0; $i < count($zonetimes); $i++){
                                        $price_data["shipping_delivery_times_id"] = $zonetimes[$i];
                                        $price_data["shipping_packages_id"] = $validatedData["shipping_packages_id"];
                                        $price_data["price"] = $zonetimesprice[$i];

                                        ShippingZonePrice::create($price_data);  
                                }
                            }
                        } else {
                            $price_data["zip_code"] = $validatedData["zip_code"];
                            $price_data["group_name"] = $validatedData["group_name"];
                            $price_data["shipping_packages_id"] = $validatedData["shipping_packages_id"];

                            for($j=0; $j < count($zonetimes); $j++){

                                $price_data["shipping_delivery_times_id"] = $zonetimes[$j];
                                $price_data["price"] = $zonetimesprice[$j];
                                $price_data["shipping_zone_groups_id"] = $zoneGroup->id;

                                ShippingZonePrice::create($price_data);  
                            }

                        }
                    break;
                
                case '2':
                        $fileName = '';
                        if (isset($validatedData['file_name'])) {
                            $file_name = $validatedData['file_name'];
                            $fileName =
                                uniqid() .
                                time() .
                                '.' .
                                $file_name->getClientOriginalExtension();
                            $file_name->move(public_path('images/zoneprices'), $fileName);
                            $validatedData['file_name'] = $fileName;
                        }

                        // Now parse the csv and store all values in DB
                        $filename = public_path('images/zoneprices/'.$fileName);
                        $file = fopen($filename, "r");
                        $all_data = array();

                        $count_header = 0;
                        while ( ($data = fgetcsv($file, 200, ",")) !==FALSE ) {

                            if($count_header > 0){
                                $group_name = $data[0];
                                $zip_code = $data[1];
                                $delivery_time = $data[2];
                                $package_name = $data[3];
                                $price = $data[4];


                                // Check if same value available for the group/package/delivery time combination then update it else add new one
                                $shippingzoneprice = ShippingZonePrice::leftjoin('shipping_packages', 'shipping_packages.id', '=', 'shipping_zone_prices.shipping_packages_id')
                                                            ->leftjoin('shipping_delivery_times', 'shipping_delivery_times.id', '=', 'shipping_zone_prices.shipping_delivery_times_id')
                                                            ->where('shipping_zone_prices.zip_code', $zip_code)
                                                            ->where('shipping_zone_prices.group_name', $group_name)
                                                            ->where('shipping_delivery_times.name', $delivery_time);
                                $shippingzonepriceCount = $shippingzoneprice->count();
                                if($shippingzonepriceCount > 0){
                                    $shippingzoneprice->update(["file_name" => $fileName,"price" => $price]);
                                } else {
                                    // Get package id
                                    $package_id = ShippingPackage::where('package_name', $package_name)->first()->id;
                                    $deliveryTime_id = ShippingDeliveryTime::where('name', $delivery_time)->first()->id;

                                    $shippingPrice = new ShippingZonePrice();
                                    $shippingPrice->group_name = $group_name;
                                    $shippingPrice->zip_code = $zip_code;
                                    $shippingPrice->price = $price;
                                    $shippingPrice->shipping_delivery_times_id = $deliveryTime_id;
                                    $shippingPrice->shipping_packages_id = $package_id;
                                    $shippingPrice->file_name = $fileName;
                                    $shippingPrice->save();
                                }                                                         
                            }

                            $count_header++;                            

                        }
                       
                    break;
                
            }

            
            
            DB::commit();
            return true;
        }
        catch(\Exception $e)
        {
            Log::info('Error'.$e->getMessage());
            DB::rollback();
           return false;
        }
    }

}
