<?php $__env->startSection('ext_css'); ?>

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
                        <form method="POST" action="<?php echo e(route('admin.products.store')); ?>" class="form-horizontal"
                            enctype="multipart/form-data" id="createProductForm">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('adminproduct::form',['action'=>'create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </form>
                        
                       

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>

<?php $__env->stopSection(); ?>

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
    </script>

    <script>
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

            $('.hpanel').on('click', '#option-values-table tbody', function() {
                $("#option-values-table tbody").last().append("<tr id </td></tr>");
            });
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorders/Modules/AdminProduct/Resources/views/create.blade.php ENDPATH**/ ?>