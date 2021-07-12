<?php $__env->startSection('ext_css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="row">
    <div class="col-md-12">
        <div class="boxed">
            <div class="boxed-wrapper">
            <div class="hpanel">
                <form method="POST" id="updatezonepriceForm" action="<?php echo e(route('admin.zoneprice.update', [$zoneprice->id])); ?>" accept-charset="UTF-8"
                    class="form-horizontal" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-3">
                                <h5><strong> Edit Zone Price</strong> </h5>
                            </div>
                            <div class="col-md-4 pull-right text-right">
                                <a class="btn btn-danger" href="<?php echo e(route('admin.zoneprice.index')); ?>">Cancel</a>
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="zoneprice_id" id="zoneprice_id" value="<?php echo e($zoneprice->id); ?>">
                    <div class="panel-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php echo $__env->make('adminshipping::shippingzoneprice.form', ['action' => 'edit'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('ext_js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorder/Modules/AdminShipping/Resources/views/shippingzoneprice/edit.blade.php ENDPATH**/ ?>