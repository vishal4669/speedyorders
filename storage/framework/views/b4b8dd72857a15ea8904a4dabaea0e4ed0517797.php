<div class="form-group">
    <label> Package</label>
    <select id="product_package_<?php echo e($productId); ?>" name="product_package_<?php echo e($productId); ?>" class="form-control <?php echo e($productId); ?>" required>
        <option value="">Select Product Shipping Package</option>
        <?php $__currentLoopData = $productPackage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <option value="<?php echo e($package->id); ?>"><?php echo e($package->package_name); ?></option>           
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<?php /**PATH /var/www/html/speedyorder/Modules/AdminOrder/Resources/views/htmlelement/package.blade.php ENDPATH**/ ?>