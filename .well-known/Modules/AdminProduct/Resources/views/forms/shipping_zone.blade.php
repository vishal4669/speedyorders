
    @php
        $firstGroup = '';
    @endphp

@if(isset($product->groups) && !empty($product->groups))
    @php
        $firstGroup = (isset($product->groups[0]) && (isset($product->groups[0]->group_id))) ? $product->groups[0]->group_id : '';
    @endphp
@endif



<div class="row">
    <div class="col-md-6">
        <label for="option">Group Name</label>
        <select name="groups[]" class="form-control js-dropdown-select2" id="groups">
            <option value="">Select Group</option>
            @foreach ($groups as $group)
                <option value="{{ $group->id }}" {{(isset($firstGroup) && $firstGroup==$group->id) ? 'selected' : ''}} >{{ $group->group_name }}</option>
            @endforeach
        </select>
    </div>   
     <div class="col-md-6">
        <label for="option " class="rows"></label>
        <button type="button" class="btn btn-success" onclick="addRow()">+</button> 
     </div>
</div>

<div id="other_divs">
    @if(isset($product->groups) && !empty($product->groups))
            @php
                $i = 0;
            @endphp

        @foreach($product->groups as $addedGroup)
            @php

                $idunique = 'div_'.rand(10000,50000);
            @endphp

            @if($i > 0)
                <div class="row morediv" id="{{$idunique}}">
                    <br>
                    <div class="col-md-6">
                        <label class="option">Group Name</label>
                        <select class="form-control js-dropdown-select2" type="number" name="groups[]">
                            <option value="">Select Group</option>
                            @foreach ($groups as $group)
                                <option {{(isset($addedGroup->group_id) && $addedGroup->group_id==$group->id) ? 'selected' : ''}} value="{{ $group->id }}">{{ $group->group_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="option " class="rows"></label>
                        <button type='button' class='btn btn-danger' onclick='removeWithNum("{{$idunique}}")'>-</button>
                    </div>
                </div>
            @endif    
            @php
                $i++;
            @endphp

        @endforeach
    @endif
</div>
<style type="text/css">
    label.rows {
    height: 15px;
}
</style>

@section('ext_js')
<script type="text/javascript">
var groups = <?php echo json_encode($groups); ?>;
var groupCount = <?php echo count($groups) - 1; ?>;
function addRow(){
    var div_counts = $(".morediv").length;
    if(div_counts < groupCount){
        var divid = 'div_'+makeid();
        var selectid = 'select_'+makeid();

        var html = '<div class="row morediv" id="'+divid+'">';
            html += '<br><div class="col-md-6">';
            html += '<label class="option">Group Name</label>';                                   
                    html += '<select id="'+selectid+'" class="form-control js-dropdown-select2" type="number" name="groups[]">';
                        html +='<option value="">Select Group</option>';

                    $.each(groups, function(i, item) {
                        html +='<option value="'+groups[i].id+'">'+groups[i].group_name+'</option>';
                    });

                    html +='</select>'
             html += '</div>';
             html += '<div class="col-md-6"><label for="option " class="rows"></label>';
             html +="<button type='button' class='btn btn-danger' onclick='removeRow("+divid+")'>-</button>";
             html += '</div>';
        html += '</div>';

        $("div#other_divs:last").append(html);
        $(".js-dropdown-select2").select2();
    } 
    return false;
}

function removeRow(id_div){
    $("#"+id_div.id).remove();
}

function removeWithNum(id_div){
    $("#"+id_div).remove();
}

function makeid() {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < 10; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}

</script>
@endsection
      