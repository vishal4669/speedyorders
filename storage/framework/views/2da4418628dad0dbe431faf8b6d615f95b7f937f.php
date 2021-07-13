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
                <option value="<?php echo e($optionValue->id); ?>"><?php echo e($optionValue->optionValue->name); ?></option>
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
            var url = '<?php echo e(route('admin.products.ajax.option')); ?>';
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorders/Modules/AdminProduct/Resources/views/edit.blade.php ENDPATH**/ ?>