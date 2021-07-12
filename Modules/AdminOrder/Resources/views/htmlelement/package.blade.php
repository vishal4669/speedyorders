<div class="form-group">
    <label> Package</label>
    <select id="product_package_{{$productId}}" name="product_package_{{$productId}}" class="form-control {{ $productId }}" required>
        <option value="">Select Product Shipping Package</option>
        @foreach ($productPackage as $package)

        <option value="{{ $package->id }}">{{ $package->package_name }}</option>           
        @endforeach
    </select>
</div>
