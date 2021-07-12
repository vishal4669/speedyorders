<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"><strong>Customers Details</strong></a></li>
    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Products</a></li>
    <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">Payment</a></li>
    <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">Shipping</a></li>
    <li class=""><a data-toggle="tab" href="#tab-5" aria-expanded="false">Extras</a></li>
    <li class=""><a data-toggle="tab" href="#tab-6" aria-expanded="false">Coupon</a></li>
</ul>
<br>

<div class="tab-content">

    <div id="tab-1" class="tab-pane active">
        <?php echo $__env->make('adminorder::formelements.general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div id="tab-2" class="tab-pane">
        <?php echo $__env->make('adminorder::formelements.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div id="tab-3" class="tab-pane">
        <?php echo $__env->make('adminorder::formelements.payment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div id="tab-4" class="tab-pane">
        <?php echo $__env->make('adminorder::formelements.shippment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div id="tab-5" class="tab-pane">
        <?php echo $__env->make('adminorder::formelements.extra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div id="tab-6" class="tab-pane">

        <div class="form-group">
            <label class="control-label">Choose Coupon</label>
                <select name="coupon_id" class="form-control js-dropdown-select2" id="coupon_id">
                    <option value="">Select</option>

                    <?php if(old('coupon_id') || !isset($coupons)): ?>
                        <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($coupon->id); ?>" <?php if($coupon->id==old('coupon_id')): ?> selected <?php endif; ?> ><?php echo e($coupon->code); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($coupon->id); ?>" <?php if($coupon->id==old('coupon_id',$coupon->id)): ?> selected <?php endif; ?>><?php echo e($coupon->code); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
        </div>

    </div>

</div>


<?php /**PATH /var/www/html/speedyorder/Modules/AdminOrder/Resources/views/form.blade.php ENDPATH**/ ?>