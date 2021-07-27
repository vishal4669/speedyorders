<h5>Single</h5>
<table class="table table-bordered">
  <thead>
     <tr>
        <td style="width:10%"><b>Product ID</b></td>
        <td style="width:30%"><b>Product</b></td>
        <td style="width:50%"><b>Package</b></td>
     </tr>
  </thead>
  <tbody>    
    @if(!empty($singalarr))
        @foreach($singalarr as $singleproduct)     
             <tr>
                <td>{{ $singleproduct["id"] }}</td>
                <td>{{ $singleproduct["name"] }}</td>                                  
                <td>{{ $singleproduct["package"] }}</td>
             </tr>
        @endforeach
    @else
        <tr>
            <td colspan="7" class="text-center">No Single Product Selected</td>
        </tr>
    @endif    
     
  </tbody>
</table>

<h5>Combo</h5>

<table class="table table-bordered">
  <thead>
     <tr>
        <td style="width:30%"><b>Product ID</b></td>
        <td style="width:70%"><b>Product</b></td>
     </tr>
  </thead>
  <tbody>    
    @if(!empty($comboarr))
        @foreach($comboarr as $comboproduct)     
             <tr>
                <td>{{ $comboproduct["id"] }}</td>
                <td>{{ $comboproduct["name"] }}</td>                   
             </tr>
        @endforeach
    @else
        <tr>
            <td colspan="7" class="text-center">No Combo Product Selected</td>
        </tr>
    @endif      
     
  </tbody>
</table>

<h5>Size for Combo</h5>

<div class="form-group">
    <label class="col-md-1 control-label">Length</label>
    <div class="col-md-1">
        <input type="number" placeholder="Length" min="0" name="package_length" class="form-control">
    </div>

    <label class="col-md-1 control-label">Width</label>
    <div class="col-md-1">
        <input type="number" placeholder="Width" min="0" name="package_width" class="form-control">
    </div>

    <label class="col-md-1 control-label">Height</label>
    <div class="col-md-1">
        <input type="number" min="0" placeholder="Height" name="package_height" class="form-control">
    </div>

    <div class="col-md-1">
       <select class="form-control m-b js-dropdown-select2" name="package_size_unit" required>
            <option value="cm" selected>CM</option>
            <option value="inch">INCH</option>
        </select>
    </div>

    <label class="col-md-1 control-label">Weight</label>

    <div class="col-md-1">
        <input type="text" name="package_weight" placeholder="Weight" class="form-control">
    </div>


    <div class="col-md-1">
       <select class="form-control m-b js-dropdown-select2" name="package_weight_unit">
            <option value="1" selected>KG</option>
            <option value="2">LB</option>
        </select>
    </div>

</div>

