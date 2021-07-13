
<div class="form-group <?php echo e($errors->has('state_code') ? 'has-error' : ''); ?>">
    <label for="state_code" class="control-label"><?php echo e('State Code'); ?></label>
    <input class="form-control" type="text" name="state_code" id="state_code" value="<?php echo e(old('state_code', isset($tax->state_code) ? $tax->state_code : null)); ?>" > </input>

    <?php echo $errors->first('state_code', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('tax_percentage') ? 'has-error' : ''); ?>">
    <label for="slug" class="control-label"><?php echo e('Tax Percentage'); ?></label>
    <input class="form-control" type="text" name="tax_percentage" id="tax_percentage" value="<?php echo e(old('tax_percentage', isset($tax->tax_percentage) ? $tax->tax_percentage : null)); ?>" > </input>

    <?php echo $errors->first('tax_percentage', '<p class="help-block">:message</p>'); ?>

</div>


<div class="form-group <?php echo e($errors->has('is_default') ? 'has-error' : ''); ?>">
    <label for="is_default" class="control-label"><?php echo e('Default'); ?></label>
    <select name="is_default" class="form-control js-dropdown-select2" id="is_default" >
    <?php
        $status = [0=>'No', 1=>'Yes'];
    ?>
    <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($optionKey); ?>" <?php echo e((isset($tax->is_default) && $tax->is_default == $optionKey) ? 'selected' : ''); ?>><?php echo e($optionValue); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
    <?php echo $errors->first('is_default', '<p class="help-block">:message</p>'); ?>

</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="<?php echo e($formMode === 'edit' ? 'Update' : 'Create'); ?>">
</div>
<?php /**PATH /var/www/html/speedyorders/Modules/AdminStateTax/Resources/views/form.blade.php ENDPATH**/ ?>