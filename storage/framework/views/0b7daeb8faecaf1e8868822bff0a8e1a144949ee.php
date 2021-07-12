<div class="form-group <?php echo e($errors->has('comment') ? 'has-error' : ''); ?>">
    <label for="comment" class="control-label"><?php echo e('Comment'); ?></label>
    <textarea class="form-control" rows="5" name="comment" type="textarea" id="comment"><?php echo e(isset($order->comment) ? $order->comment : old('comment')); ?></textarea>
    <?php echo $errors->first('comment', '<p class="help-block">:message</p>'); ?>

</div>

<div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
    <label for="status" class="control-label"><?php echo e('Status'); ?></label>
    <select name="status" class="form-control" id="status">
        <?php $__currentLoopData = json_decode('{"1":"Active","0":"Inactive"}', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($optionKey); ?>" <?php echo e((isset($order->status) && $order->status == $optionKey) ? 'selected' : old('status')); ?>><?php echo e($optionValue); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

</div>

<div class="form-group <?php echo e($errors->has('commisison') ? 'has-error' : ''); ?>">
    <label for="commisison" class="control-label"><?php echo e('Commisison'); ?></label>
    <input class="form-control" type="number" name="commisison" id="commisison" value="<?php echo e(isset($order->commisison) ? $order->commisison : old('commisison')); ?>">

    <?php echo $errors->first('commisison', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('currency_code') ? 'has-error' : ''); ?>">
    <label for="currency_code" class="control-label"><?php echo e('Currency Code *'); ?></label>
    <input class="form-control" type="text" name="currency_code" id="currency_code" value="<?php echo e(isset($order->currency_code) ? $order->currency_code : old('currency_code')); ?>">

    <?php echo $errors->first('currency_code', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('currency_value') ? 'has-error' : ''); ?>">
    <label for="currency_value" class="control-label"><?php echo e('Currency Value *'); ?></label>
    <input class="form-control" type="number" name="currency_value" id="currency_value" value="<?php echo e(isset($order->currency_value) ? $order->currency_value : old('currency_value')); ?>">

    <?php echo $errors->first('currency_value', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('ip') ? 'has-error' : ''); ?>">
    <label for="ip" class="control-label"><?php echo e('Ip'); ?></label>
    <input class="form-control" type="text" name="ip" id="ip" value="<?php echo e(isset($order->ip) ? $order->ip : old('ip')); ?>">

    <?php echo $errors->first('ip', '<p class="help-block">:message</p>'); ?>

</div><?php /**PATH /var/www/html/speedyorder/Modules/AdminOrder/Resources/views/formelements/extra.blade.php ENDPATH**/ ?>