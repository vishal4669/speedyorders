<?php $__env->startSection('ext_css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-10">
        <div class="hpanel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Add State Tax</h4>
            </div>
            <div class="panel-body">
            
            <form method="POST" action="<?php echo e(route('admin.reports.tax.store')); ?>" class="form-horizontal" enctype="multipart/form-data" id="createProductForm">
                    <?php echo csrf_field(); ?>

                    <?php echo $__env->make('adminstatetax::form', ['formMode' => 'create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('ext_js'); ?>

<script src="<?php echo e(asset('/vendor/ckeditor/ckeditor.js')); ?>"></script>

<script>
    CKEDITOR.replace( 'return_policy' );
    CKEDITOR.replace( 'description' );
</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorders/Modules/AdminStateTax/Resources/views/create.blade.php ENDPATH**/ ?>