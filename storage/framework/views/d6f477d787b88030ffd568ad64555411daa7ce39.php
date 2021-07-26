<div class="row">
            <div class="col-md-6">
                <label for="option">Option Required</label>
                <select name="option_required" class="form-control">
                    <option value="1"
                    <?php if(isset($product->options) && $product->options->first()!=null && $product->options->first()->required ==1): ?> selected <?php endif; ?>>
                    Yes</option>
                    <option value="0"
                    <?php if(isset($product->options) && $product->options->first()!=null && $product->options->first()->required ==0): ?> selected <?php endif; ?>>
                    No</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="option">Options</label>
                <select class="form-control " list="options" id="options">
                    <option value="">select options</option>
                    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($option->id); ?>"><?php echo e($option->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="options-panel">
            <?php if($action == 'edit'): ?>
                <?php $__empty_1 = true; $__currentLoopData = $product->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter=>$productOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php switch($productOption->option->type):
                        case ('input'): ?>
                        <div class="hpanel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5><strong><?php echo e($productOption->option->name); ?></strong> </h5>
                                    </div>
                                    <div class="col-md-4 pull-right text-right">
                                        <button class="btn btn-danger delete-hpanel"><i class="pe-7s-close-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="option-values-table"
                                    class="footable table table-bordered toggle-arrow-tiny default breakpoint footable-loaded"
                                    data-page-size="8" data-filter="#filter">
                                    <thead>
                                        <tr>
                                            <th class="footable-visible">Value</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="display: table-row;" class="footable-even">
                                            <td class="footable-visible" colspan="5">
                                                <input type="text" class="form-control"
                                                    name="option[input][<?php echo e($productOption->option->id); ?>]"
                                                    value="<?php echo e($productOption->optionValues->first()->input_value); ?>" required>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php break; ?>
                        <?php case ('select'): ?>
                        <div class="hpanel">
                            <input type="text" class="hidden" name="option_id[<?php echo e($counter); ?>]"
                                value="<?php echo e($option->id); ?>">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5><strong><?php echo e($productOption->option->name); ?></strong> </h5>
                                    </div>
                                    <div class="col-md-4 pull-right text-right">
                                        <a class="btn btn-danger delete-hpanel"><i class="pe-7s-close-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table
                                    class="option-values-table footable table table-bordered toggle-arrow-tiny default breakpoint footable-loaded"
                                    data-page-size="8" data-filter="#filter">
                                    <thead>
                                        <tr>
                                            <th class="footable-visible">Value</span></th>
                                            <th class="footable-visible footable-sortable">Quantity</span></th>
                                            <th class="footable-visible footable-sortable">Subtract stock</span></th>
                                            <th class="footable-visible footable-sortable">prefix</span></th>
                                            <th class="footable-visible footable-sortable">Price</span></th>
                                            <th class="footable-sortable">Operation</span></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody<?php echo e($option->id); ?>">
                                        <?php $__currentLoopData = $productOption->optionValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productOptionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr style="display: table-row;" class="footable-even">
                                                <td class="footable-visible">
                                                    <input type="hidden" name="option[select][option_data][<?php echo e($counter); ?>][]" value="<?php echo e($option->id); ?>">

                                                    <select name="option[select][option_values][<?php echo e($counter); ?>][]"
                                                        class="form-control">
                                                        <?php $__currentLoopData = $productOption->option->optionValues ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($item->id); ?>"
                                                                <?php echo e($item->id == $productOptionValue->option_value_id ? 'selected' : ''); ?>>
                                                                <?php echo e($item->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td class="footable-visible">
                                                    <input type="number" value="<?php echo e($productOptionValue->quantity); ?>"
                                                        class="form-control"
                                                        name="option[select][quantity][<?php echo e($counter); ?>][]"
                                                        value="<?php echo e('s'); ?>" placeholder="Total Option Stock" required>
                                                </td>
                                                <td class="footable-visible">
                                                    <select name="option[select][subtract_from_stock][<?php echo e($counter); ?>][]"
                                                        class="form-control" required>
                                                        <option value="1" <?php if($productOptionValue->subtract_from_stock == 1): ?> selected <?php endif; ?>>Yes</option>
                                                        <option value="0" <?php if($productOptionValue->subtract_from_stock == 0): ?> selected <?php endif; ?>>No</option>
                                                    </select>
                                                </td>
                                                <td class="footable-visible">
                                                    <select name="option[select][price_prefix][<?php echo e($counter); ?>][]"
                                                        class="form-control" required>
                                                        <option value="1"
                                                            <?php echo e($productOptionValue->price_prefix == '1' ? 'selected' : ''); ?>>+
                                                        </option>
                                                        <option value="0"
                                                            <?php echo e($productOptionValue->price_prefix == '0' ? 'selected' : ''); ?>>-
                                                        </option>
                                                    </select>

                                                </td>
                                                <td class="footable-visible">
                                                    <input type="number" value="<?php echo e($productOptionValue->price); ?>"
                                                        class="form-control"
                                                        name="option[select][price][<?php echo e($counter); ?>][]" placeholder="Price"
                                                        required>
                                                </td>
                                                <td class="footable-visible footable-last-column"><a
                                                        class="remove-option-value btn btn-danger"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>
                                        <tr style="display: table-row;" class="footable-even">
                                            <td class="footable-visible" colspan="5"></td>
                                            <td class="footable-visible footable-last-column"><a
                                                    class="btn btn-primary add-option-value"
                                                    data-option-id="<?php echo e($option->id); ?>"><i class="fa fa-plus"></i></a>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <?php break; ?>
                    <?php endswitch; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
            <?php endif; ?>
        </div>

<?php $__env->startSection('ext_js'); ?>
 <script type="text/javascript">
        $(document).ready(function() {
            var url = '<?php echo e(route('admin.products.ajax.option')); ?>';
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var counter = 0;
            $("#options").change(function() {

                var optionsId = $(this).val();
                $.ajax({
                    /* the route pointing to the post function */
                    url: url,
                    type: 'post',
                    /* send the csrf-token and the input to the controller */
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "counter": counter,
                        "optionId": optionsId
                    },
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function(data) {
                        $('.options-panel').append(data.html);
                        counter++;
                    }
                });
            });

            $('.hpanel').on('click', '.delete-hpanel', function() {
                $(this).parent().parent().parent().parent().remove();
            });

            $('.hpanel').on('click', '.remove-option-value', function() {
                $(this).parent().parent().remove();
            });

            $('.hpanel').on('click', '.add-option-value', function() {

                var optionUrl = '<?php echo e(route('admin.products.ajax.option.value')); ?>';
                var optionId = $(this).data('option-id');

                alert(optionId);


                $.ajax({
                    /* the route pointing to the post function */
                    url: optionUrl,
                    type: 'post',
                    /* send the csrf-token and the input to the controller */
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "counter": counter,
                        "optionId": optionId
                    },
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function(data) {
                        console.log($('#tbody'+optionId));
                        $('#tbody'+optionId).append(data.html);
                    }
                });
            });
        });

    </script>

    <script type="text/javascript">
        var imgSrc = '<?php echo e(asset("/images/products/")); ?>';

        $(document).ready(function(e){
            $('#uploadImagesBtn').hide();
            var galleryIds = $('#oldGalleryId').val();

            if(galleryIds!==undefined)
            {
                $.ajax({
                url: '/admin/products/get-product-media/'+galleryIds,
                type: "GET",
                success:function(res){
                    var htmlELement = '';
                    for(var i=0;i<res['data'].length;i++)
                    {
                        htmlELement += '<tr id="'+res["data"][i]["id"]+'"style="display: table-row;" class="footable-even">'
                        htmlELement += '<td class="footable-visible"> <img src="'+imgSrc+'/'+res["data"][i]["image"]+'" alt="" style="width:100px;"></td>'
                        htmlELement += '<td class="footable-visible footable-last-column"> <button type="button" class="btn btn-danger deleteGalleryImage"><i class="fa fa-trash"></i></button></td>'
                        htmlELement += '</tr>'
                    }
                    $('#galleryBody').append(htmlELement);
                },
                });
            }
        });


        $('#addGalleryImage').on('click',function(e)
        {
            e.preventDefault();
            $('#gallery-table tbody').append("<tr id='' style='display: table-row;' class='footable-even'><td class='footable-visible footable-first-column'> <input type='file' class='form-control' name='gallery_image[]'/> </td><td class='footable-visible'> <input type='number' class='form-control' name='gallery_image_order[]'' placeholder='Sort Order' value='1' min='1'/> </td><td class='footable-visible footable-last-column'> <button type='button' class='btn btn-danger deleteGalleryImage'><i class='fa fa-trash'></i> </button> </td></tr>");
            $('#uploadImagesBtn').show();
        });

        $(document).on('click','.deleteGalleryImage',function(e){
            e.preventDefault();
            var rowCount = $('#galleryBody tr').find('input[type="file"]').length;

            if(rowCount<=1)
            {
                $('#uploadImagesBtn').hide();
            }
            
            var id = $(this).closest('tr').attr('id');
            
            $(this).closest('tr').remove();
            if(id)
            {
                $.ajax({
                url: '/admin/products/delete-product-media/'+id,
                type: "GET",
                success:function(res){
                    console.log('success');
                },
                });
            }
        });

        $(document).on('click','.editGalleryImage',function(e)
        {
            e.preventDefault();
            var id = $(this).closest('tr').attr('id');
            if(id)
            {
                $.ajax({
                url: '/admin/products/get-single-product-media/'+id,
                type: "GET",
                success:function(res)
                {
                    $('#singleGalleryId').val(id);
                    $('#optionValueId').val(res['data']['product_option_value_id']);
                    $('#sortOrder').val(res['data']['order']);
                    $('#galleryImg').attr('src','http://'+document.location.host+'/images/products/'+res['data']['image']);
                    $('#exampleModal').modal('show');
                },
                });
            }
        });

        $('#updateSingleGallery').on('submit',function(e){
            e.preventDefault();
            var action = $(this).attr('action');
            var formData =  new FormData(this);


            $.ajax({
                url: action,
                type: "POST",
                data: formData,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(res){
                    $('#exampleModal').modal('hide');
                },

            });

        });

        $('#uploadProductMediaForm').on('submit',function(e)
        {
            e.preventDefault();
            var action = $(this).attr('action');
            var formData =  new FormData(this);

            $.ajax({
            url: action,
            type: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend :function(){
                $('#uploadImagesBtn').prop('disabled', true);
                $('#uploadImagesBtn').html("<span class='spinner-border spinner-border-sm' id='uploadImagesBtn' role='status' aria-hidden='true'></span> Please Wait...");
            },
            success:function(res){
                $('#uploadImagesBtn').prop('disabled',false);
                $('#uploadImagesBtn').html("<span id='uploadImagesBtn' role='status' aria-hidden='true'></span> Upload Image");
                $('#uploadImagesBtn').hide();
                var oldId = $('#galleryId').val();
                $('#galleryId').val(res['id']+','+oldId);
                assignIdToRow(res['data'],res['id']);
            },

            });
        });

        function assignIdToRow(responseDataArray,responseIdArray){
            var htmlELement = '';
            var rowCount = $('#galleryBody tr').length;

            if(rowCount>0)
            {
                for(var i=0;i<(responseDataArray.length);i++)
                {

                    $("#galleryBody").find("tr:nth-child("+rowCount+")").empty();

                    htmlELement += '<td class="footable-visible"> <img src="'+imgSrc+'/'+responseDataArray[i]["image"]+'" alt="" style="width:100px;"></td>'
                    htmlELement += '<td class="footable-visible">'+responseDataArray[i]["order"]+'</td>'
                    htmlELement += '<td class="footable-visible footable-last-column"> <button type="button" class="btn btn-danger deleteGalleryImage"><i class="fa fa-trash"></i></button></td>'

                    $("#galleryBody").find("tr:nth-child("+rowCount+")").html(htmlELement);
                    $("#galleryBody").find("tr:nth-child("+rowCount+")").attr('id',responseIdArray[i]);
                    rowCount=rowCount-1;
                    htmlELement = '';
                }
            }
        }

        function showDetails(unquie_id){
            $("#group_data_info").hide();
            if(unquie_id.length=='9'){
               var selected_groupid = $("#group_"+unquie_id).val();
            } else{
                var selected_groupid = $("#"+unquie_id.id).val();
            }

            if(selected_groupid==''){
                alert('Please select group to get details');
                return false;
            }

            $.ajax({
                url: '/admin/products/get-group-details/'+selected_groupid,
                type: "GET",
                success:function(res){
                    var htmlELement = '';
                    for(var i=0;i<res['data'].length;i++)
                    {
                        htmlELement += '<tr style="display: table-row;" class="footable-even">'
                        htmlELement += '<td class="footable-visible"> '+res["data"][i]["package"]['package_name']+'</td>'
                        htmlELement += '<td class="footable-visible">'+res["data"][i]["zip_code"]+'</td>'
                        htmlELement += '<td class="footable-visible">'+res["data"][i]["deliverytime"]['name']+'</td>'
                        htmlELement += '<td class="footable-visible">'+res["data"][i]["price"]+'</td>'
                        htmlELement += '</tr>'
                    }
                    $("#group_label").html(res['data'][0]['group']['group_name']);
                    $("#group_data_info").show();
                    $("#prices_body").html('');
                    $('#group_details_table').append(htmlELement);
                },
            });
        }

        var groups = <?php echo json_encode($groups); ?>;
        var groupCount = <?php echo count($groups) - 1; ?>;
        function addRow(){
            var div_counts = $(".morediv").length;
            if(div_counts < groupCount){
                var divid = 'div_'+makeid();
                var selectid = 'select_'+makeid();

                var html = '<div class="row morediv" id="'+divid+'">';
                    html += '<br><div class="col-md-9">';
                    html += '<label class="option">Group Name</label>';                                   
                            html += '<select id="'+selectid+'" class="form-control js-dropdown-select2" type="number" name="groups[]">';
                                html +='<option value="">Select Group</option>';

                            $.each(groups, function(i, item) {
                                html +='<option value="'+groups[i].id+'">'+groups[i].group_name+'</option>';
                            });

                            html +='</select>'
                     html += '</div>';
                     html += '<div class="col-md-3"><label for="option " class="rows"></label>';
                     html +="<button type='button' class='btn btn-danger' onclick='removeRow("+divid+")'>-</button>&nbsp;";
                     html +="<button type='button' title='View Selected Group Details' class='btn btn-info' onclick='showDetails("+selectid+")'>info</button>";
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
    <?php $__env->stopSection(); ?><?php /**PATH /var/www/html/speedyorders/Modules/AdminProduct/Resources/views/forms/option.blade.php ENDPATH**/ ?>