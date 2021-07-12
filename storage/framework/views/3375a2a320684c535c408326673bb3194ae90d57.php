<div class="form-group">
    <label> Select <?php echo e($option->name); ?></label>
    <select data-option="<?php echo e($option->name); ?>" id="[select][<?php echo e($productOption->id); ?>]" name="option[<?php echo e($productId); ?>][select][<?php echo e($productOption->id); ?>]" class="form-control <?php echo e($productId); ?>" required>
        <?php $__currentLoopData = $productOption->optionValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($ov->id); ?>"><?php echo e($ov->optionValue->name); ?></option>           
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<?php /**PATH /var/www/html/speedyorder/Modules/AdminOrder/Resources/views/htmlelement/select.blade.php ENDPATH**/ ?>