<div class="" id="product-gallery">
</div>
<div class="panel-heading">
    <div class="row">
        <div class="col-md-3">
            <h5><strong><?php echo e(ucfirst($action) ?? null); ?> Product</strong> </h5>
        </div>
        <div class="col-md-4 pull-right text-right">
            <button class="btn btn-success" type="submit"><?php echo e($action == 'create' ? 'SAVE' : 'UPDATE'); ?></button>
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

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"><strong>General Info</strong></a>
        </li>
        <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Category</a></li>
        <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">Options</a></li>
        <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">Related Product</a></li>
        <?php /*<li class=""><a data-toggle="tab" href="#tab-5" aria-expanded="false">Shipping Zone</a></li> */?>
        <li class=""><a data-toggle="tab" href="#tab-6" aria-expanded="false">Delivery Times</a></li>
    </ul>
    <br>

    <div class="tab-content">

        <div id="tab-1" class="tab-pane active">
            <?php echo $__env->make('adminproduct::forms.general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div id="tab-2" class="tab-pane product-category-tab">
            <?php echo $__env->make('adminproduct::forms.category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div id="tab-3" class="tab-pane">
            <?php echo $__env->make('adminproduct::forms.option', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div id="tab-4" class="tab-pane">
            <?php echo $__env->make('adminproduct::forms.related_product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <?php /*
        <div id="tab-5" class="tab-pane">
            @include('adminproduct::forms.shipping_zone')
        </div>
        */?>
        <div id="tab-6" class="tab-pane">
            <?php echo $__env->make('adminproduct::forms.delivery_times', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

</div>

<?php /**PATH /var/www/html/speedyorders/Modules/AdminProduct/Resources/views/form.blade.php ENDPATH**/ ?>