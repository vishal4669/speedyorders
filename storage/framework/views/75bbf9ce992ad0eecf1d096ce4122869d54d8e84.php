<div class="row">
    <label class="col-md-2 control-label">Related products</label>
    <div class="col-md-8">
        <select class="form-control js-dropdown-select2" name="related_products[]">
            <option value="">Select related product</option>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($pro->id); ?>"><?php echo e($pro->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<?php /**PATH /var/www/html/speedyorder/Modules/AdminProduct/Resources/views/forms/related_product.blade.php ENDPATH**/ ?>