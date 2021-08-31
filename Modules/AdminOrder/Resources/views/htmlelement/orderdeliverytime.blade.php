<div class="form-group">
    <select data-option="DeliveryTime" name="{{$selectnamedeliverytime}}" class="form-control {{ $productId }}" required>
        @foreach ($productDeliveryTimes as $timedetails)
            
           <option value="{{$timedetails->shipping_delivery_times_id}}">{{ucfirst($timedetails->delivery_time_name->name)}}</option>
            
        @endforeach
    </select>
</div>
