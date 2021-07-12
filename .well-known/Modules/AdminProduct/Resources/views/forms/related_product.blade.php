<div class="row">
    <label class="col-md-2 control-label">Related products</label>
    <div class="col-md-8">
        <select class="form-control js-dropdown-select2" name="related_products[]">
            <option value="">Select related product</option>
            @foreach($products as $pro)
                <option value="{{$pro->id}}">{{$pro->name}}</option>
            @endforeach
        </select>
    </div>
</div>
