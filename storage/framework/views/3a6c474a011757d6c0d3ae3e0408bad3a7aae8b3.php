
    <?php
        $firstGroup = '';
    ?>

<?php if(isset($product->groups) && !empty($product->groups)): ?>
    <?php
        $firstGroup = (isset($product->groups[0]) && (isset($product->groups[0]->group_id))) ? $product->groups[0]->group_id : '';
    ?>
<?php endif; ?>

<div class="col-md-12">
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-9">
                <label for="option">Group Name</label>
                <select name="groups[]" class="form-control js-dropdown-select2" id="group_div_11111">
                    <option value="">Select Group</option>
                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($group->id); ?>" <?php echo e((isset($firstGroup) && $firstGroup==$group->id) ? 'selected' : ''); ?> ><?php echo e($group->group_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>   
             <div class="col-md-3">
                <label for="option " class="rows"></label>
                <button type="button" class="btn btn-success" onclick="addRow()">+</button>
                <button type='button' class='btn btn-info' onclick='showDetails("<?php echo 'div_11111';?>")'>!</button>
             </div>
            
        </div>

        <div id="other_divs">
            <?php if(isset($product->groups) && !empty($product->groups)): ?>
                    <?php
                        $i = 0;
                    ?>

                <?php $__currentLoopData = $product->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addedGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php

                        $idunique = 'div_'.rand(10000,50000);
                    ?>

                    <?php if($i > 0): ?>
                        <div class="row morediv" id="<?php echo e($idunique); ?>">
                            <br>
                            <div class="col-md-9">
                                <label class="option">Group Name</label>
                                <select class="form-control js-dropdown-select2" id="group_<?php echo e($idunique); ?>" type="number" name="groups[]">
                                    <option value="">Select Group</option>
                                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e((isset($addedGroup->group_id) && $addedGroup->group_id==$group->id) ? 'selected' : ''); ?> value="<?php echo e($group->id); ?>"><?php echo e($group->group_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="option " class="rows"></label>
                                <button type='button' class='btn btn-danger' onclick='removeWithNum("<?php echo e($idunique); ?>")'>-</button>
                                <button type='button' title="View Selected Group Details" class='btn btn-info' onclick='showDetails("<?php echo e($idunique); ?>")'>i</button>
                            </div>
                           
                        </div>
                    <?php endif; ?>    
                    <?php
                        $i++;
                    ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-info" id="group_data_info" style="display:none">         
          <div class="card-body">
            <h3 id="group_label"></h3>
            <div class="row">
                <table style="width:100%" id="group_details_table" class="table-responsive table">
                    <thead>
                        <tr>
                            <th>Package</th>
                            <th>Zip Code</th>
                            <th>Delivery Time</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody id="prices_body">
                    </tbody>
                </table>
                         
            </div>
          </div>
        
        </div>
    </div>
</div>




    

<style type="text/css">
    label.rows {
    height: 15px;
}
</style>

<?php $__env->startSection('ext_js'); ?>

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

        $(document).on('click','.deleteGalleryImage',function(e)
        {
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

    </script>
    
<script type="text/javascript">
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
             html +="<button type='button' title='View Selected Group Details' class='btn btn-info' onclick='showDetails("+selectid+")'>i</button>";
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
<?php $__env->stopSection(); ?>
      <?php /**PATH /var/www/html/speedyorders/Modules/AdminProduct/Resources/views/forms/shipping_zone.blade.php ENDPATH**/ ?>