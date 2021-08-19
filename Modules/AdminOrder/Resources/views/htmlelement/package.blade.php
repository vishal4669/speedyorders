<div class="form-group">
    <select data-option="DeliveryTime" name="{{$selectname}}" class="form-control {{ $productId }}" required>
        @foreach ($productPackage as $ov)
            <option value="{{ $ov->id }}">{{ $ov->package_name }}</option>           
        @endforeach
    </select>
</div>
