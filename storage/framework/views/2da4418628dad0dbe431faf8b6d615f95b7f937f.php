<?php $__env->startSection('ext_css'); ?>
    <!-- DropZone Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">


    <style>
        label {
            display: block;
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="boxed">
                <div class="boxed-wrapper">
                    <div class="hpanel">

                        <form method="POST" action="<?php echo e(route('admin.products.update', [$product->id])); ?>"
                            class="form-horizontal" enctype="multipart/form-data" id="createProductForm">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('adminproduct::form',['action'=>'edit'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php /*
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="boxed">
                <div class="boxed-wrapper">
                    <div class="hpanel">
                        <div class="panel-heading">
                            <h5><strong>Product Images</strong> </h5>
                        </div>
                        <div class="panel-body">
                            @include('adminproduct::forms.gallery')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> */?>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Gallery</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo e(route('admin.products.update.single.media')); ?>" method="POST" enctype="multipart/form-data" id="updateSingleGallery">
            <?php echo csrf_field(); ?>
        <div class="modal-body">



            <input type="hidden" name="singleGalleryId" id="singleGalleryId" value="">
            <input type="file" name="galleryImage" id="galleryImage"> <br>
            <img src="" alt="" id="galleryImg" style="width: 100px;"> <br>
            <input type="text" value="" name="order" id="sortOrder"> <br>
            <select name="optionValueId" id="optionValueId" class="form-control">
                <option value="">None</option>
                <?php $__currentLoopData = $productOptionValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($optionValue->id); ?>"><?php echo e((isset($optionValue->optionValue->name) && $optionValue->optionValue->name!='') ? $optionValue->optionValue->name : ''); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('ext_js'); ?>


   
    <script>
        $(document).ready(function() {
           /* var url = '<?php echo e(route('admin.products.ajax.option')); ?>';
            var counter = 0;
            $("#options").change(function() {
                var optionsId = $(this).val();
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "counter": counter,
                        "optionId": optionsId
                    },
                    dataType: 'JSON',
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
                $.ajax({
                    url: optionUrl,
                    type: 'post',
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "counter": counter,
                        "optionId": optionId
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        console.log($('#tbody'+optionId));
                        $('#tbody'+optionId).append(data.html);
                    }
                });
            });*/

            var group_url = '<?php echo e(route('admin.products.ajax.group')); ?>';
            var group_counter = 0;
            $("#groups").change(function() {
                var groupId = $(this).val();
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "counter": group_counter,
                        "groupId": groupId
                    },
                    dataType: 'JSON',
                    success: function(data) {
                       
                        counter++;
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




   /* function showDetails(unquie_id){
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
    }*/

    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorders/Modules/AdminProduct/Resources/views/edit.blade.php ENDPATH**/ ?>