<?php $__env->startSection('ext_css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-9">
        <div class="boxed">
            <div class="boxed-wrapper">
                <div class="hpanel">
                    <form method="POST" action="<?php echo e(route('admin.pages.store')); ?>" class="form-horizontal" enctype="multipart/form-data" id="createProductForm">
                            <?php echo csrf_field(); ?>
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5><strong>Create Admin page</strong> </h5>
                                </div>
                                <div class="col-md-4 pull-right text-right">
                                    <button class="btn btn-success" type="submit">Create</button>
                            </div>
                        </div>
                        </div>
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
                            <?php echo $__env->make('adminpage::form', ['formMode' => 'create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('ext_js'); ?>

<script src="<?php echo e(asset('/vendor/ckeditor/ckeditor.js')); ?>"></script>

<script>
    CKEDITOR.replace( 'content' );
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorder/Modules/AdminPage/Resources/views/create.blade.php ENDPATH**/ ?>