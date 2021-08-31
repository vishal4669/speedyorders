@extends('layouts.main')
<style type="text/css">
    input.product_count {
        width: 60px;
        height: 33px;
        border-radius: 3px;
        border: 1px solid dimgray;
    }
    .pagination{
        float: right;
    }
</style>
@section('content')
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Inventory</h4>
            </div>
                     
        </div>
            <div class="table-responsive">
            <table id="inventryTable" class="table table-bordered table-striped speedy-table">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Available</th>
                    <th>Stock Alert</th>
                    <th>Edit Quantity Available</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($inventries as $inventry)
                <tr>
                    <td><img src="{{ asset('images/products/'.$inventry->image) }}" alt="" style="width:50px;"></td>
                    <td>{{ $inventry->name }}</td>
                    <td>{{ $inventry->sku }}</td>
                    <td id="available_{{$inventry->id}}">{{ ($inventry->available) ? $inventry->available : 0 }}</td>
                    <td> <input style="width:75px; clear: both" type="number" min="0" name="product_stock_alert" class="product_count" value="{{ $inventry->alert_qty }}" id="product_stock_alert_{{$inventry->id}}"></td>
                    <td>
                     <input data-size="normal" type="checkbox" checked id="product_type_{{$inventry->id}}" data-toggle="toggle" data-on="Add" data-off="Set">
                     <input type="number" min="0" name="product_count" class="product_count" id="product_count_{{$inventry->id}}">
                    </td>
                    <td> <button style="width:100%; clear: both" type="button" onclick="saveProductInventry('{{$inventry->id}}')" class="btn btn-info">Save</button></td>
                </tr>
                @empty
                <tfoot>
                    <tr>
                        <td class="text-center" colspan="10">
                            <span>No data available in the table...</span>
                        </td>
                    </tr>
                </tfoot>
                @endforelse
            </tbody>
            </table>


            {{ $inventries->links() }}

            </div>
        </div>
    </div>
</div>

@include('commons.delete_modal')
@endsection
@section('ext_js')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#inventryTable').DataTable({
                "pageLength" : 10,
                "bPaginate" : false
            });
        });

        $(document).on('click', '.delete', function () {
            var actionUrl = $(this).attr('data-url');

            $('#delete-form').attr('action', actionUrl);

            $('#modal-submit').click(function (e) {
                $(this).attr('disabled', true);
                $(this).html('<i class="fa fa-spinner fa-spin" style=""></i> Please Wait...');
                $('#delete-form').submit();
            })
        });


        function saveProductInventry(product_id){
            if(product_id){
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
                });

              var alert_qty = $('#product_stock_alert_'+product_id).val();
              var available = $('#product_count_'+product_id).val();

              var type_value = $('#product_type_'+product_id).is(':checked');
 
               
              $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('admin.inventry.add.set') }}",
                data: {'alert_qty': alert_qty, 'available': available, 'type': available, 'type' : type_value, 'product_id' : product_id},
                success: function(res_data){
                    //var res_data = JSON.parse(data);

                    $('#available_'+product_id).text(res_data.available);
                    $('#product_stock_alert_'+product_id).val(res_data.alert_qty);
                    $("#product_count_"+product_id).val('');
                }
              });//end of ajax call
            }
        }




    </script>
@endsection
