<div class="form-group">
    <label> Package</label>
    <select data-option="Package" id="[select][{{$productId}}]" name="option[{{ $productId }}][select][{{ $productId }}]" class="form-control {{ $productId }}" required>
        @foreach ($productPackage as $ov)
        <option value="{{ $ov->id }}">{{ $ov->package_name }}</option>           
        @endforeach
    </select>
</div>
