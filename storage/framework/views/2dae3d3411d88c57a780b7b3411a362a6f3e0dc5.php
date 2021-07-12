<div class="form-group">
    <label class="control-label" for="product_id"><?php echo e($option->name); ?></label>
    <input type="text" id="[input][<?php echo e($productOption->id); ?>]" class="form-control <?php echo e($productId); ?>" name="option[<?php echo e($productId); ?>][input][<?php echo e($productOption->id); ?>]" placeholder="<?php echo e($option->name); ?>" 
    <?php echo e(($option->required)? 'required':''); ?>>
</div><?php /**PATH /var/www/html/speedyorder/Modules/AdminOrder/Resources/views/htmlelement/input.blade.php ENDPATH**/ ?>