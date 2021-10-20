<div class="form-group <?php echo e($errors->has('payment_first_name') ? 'has-error' : ''); ?>">
    
    <input type="checkbox" name="same_as_customer_details_shipping" id="same_as_customer_details_shipping" value="1">&nbsp;
    <label for="copy" class="control-label"><?php echo e(' Same As Customer Details '); ?></label>
</div>

<div class="form-group <?php echo e($errors->has('shipping_first_name') ? 'has-error' : ''); ?>">
    <label for="shipping_first_name" class="control-label"><?php echo e('First Name *'); ?></label>
    <input class="form-control" type="text" name="shipping_first_name" id="shipping_first_name" value="<?php echo e(isset($order->shipping_first_name) ? $order->shipping_first_name : old('shipping_first_name')); ?>">

    <?php echo $errors->first('shipping_first_name', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('shipping_last_name') ? 'has-error' : ''); ?>">
    <label for="shipping_last_name" class="control-label"><?php echo e('Last Name *'); ?></label>
    <input class="form-control" type="text" name="shipping_last_name" id="shipping_last_name" value="<?php echo e(isset($order->shipping_last_name) ? $order->shipping_last_name : old('shipping_last_name')); ?>">

    <?php echo $errors->first('shipping_last_name', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('shipping_company') ? 'has-error' : ''); ?>">
    <label for="shipping_company" class="control-label"><?php echo e('Company'); ?></label>
    <input class="form-control" type="text" name="shipping_company" id="shipping_company" value="<?php echo e(isset($order->shipping_company) ? $order->shipping_company : old('shipping_company')); ?>">

    <?php echo $errors->first('shipping_company', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('shipping_address_1') ? 'has-error' : ''); ?>">
    <label for="shipping_address_1" class="control-label"><?php echo e('Address1 *'); ?></label>
    <input class="form-control" type="text" name="shipping_address_1" id="shipping_address_1" value="<?php echo e(isset($order->shipping_address_1) ? $order->shipping_address_1 : old('shipping_address_1')); ?>">

    <?php echo $errors->first('shipping_address_1', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('shipping_address_2') ? 'has-error' : ''); ?>">
    <label for="shipping_address_2" class="control-label"><?php echo e('Address2'); ?></label>
    <input class="form-control" type="text" name="shipping_address_2" id="shipping_address_2" value="<?php echo e(isset($order->shipping_address_2) ? $order->shipping_address_2 : old('shipping_address_2')); ?>">

    <?php echo $errors->first('shipping_address_2', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('shipping_city') ? 'has-error' : ''); ?>">
    <label for="shipping_city" class="control-label"><?php echo e('City *'); ?></label>
    <input class="form-control" type="text" name="shipping_city" id="shipping_city" value="<?php echo e(isset($order->shipping_city) ? $order->shipping_city : old('shipping_city')); ?>">

    <?php echo $errors->first('shipping_city', '<p class="help-block">:message</p>'); ?>

</div>

<div class="form-group <?php echo e($errors->has('shipping_country_name') ? 'has-error' : ''); ?>">
    <label for="shipping_country_name" class="control-label"><?php echo e('Country *'); ?></label>
    <input class="form-control" type="text" name="shipping_country_name" id="shipping_country_name" value="<?php echo e(isset($order->shipping_country_name) ? $order->shipping_country_name : old('shipping_country_name')); ?>">

    <?php echo $errors->first('shipping_country_name', '<p class="help-block">:message</p>'); ?>

</div>

<div class="form-group <?php echo e($errors->has('shipping_postcode') ? 'has-error' : ''); ?>">
    <label for="shipping_postcode" class="control-label"><?php echo e('Postalcode *'); ?></label>
    <input class="form-control" type="text" name="shipping_postcode" id="shipping_postcode" value="<?php echo e(isset($order->shipping_postcode) ? $order->shipping_postcode : old('shipping_postcode')); ?>">

    <?php echo $errors->first('shipping_postcode', '<p class="help-block">:message</p>'); ?>

</div>

<div class="form-group <?php echo e($errors->has('shipping_region') ? 'has-error' : ''); ?>">
    <label for="shipping_region" class="control-label"><?php echo e('Region *'); ?></label>
    <input class="form-control" type="text" name="shipping_region" id="shipping_region" value="<?php echo e(isset($order->shipping_region) ? $order->shipping_region : old('shipping_region')); ?>">

    <?php echo $errors->first('shipping_region', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('shipping_method') ? 'has-error' : ''); ?>">
    <label for="shipping_method" class="control-label"><?php echo e('Method *'); ?></label>
    <input class="form-control" type="text" name="shipping_method" id="shipping_method" value="<?php echo e(isset($order->shipping_method) ? $order->shipping_method : old('shipping_method')); ?>">

    <?php echo $errors->first('shipping_method', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('shipping_unique_code') ? 'has-error' : ''); ?>">
    <label for="shipping_unique_code" class="control-label"><?php echo e('Unique Code *'); ?></label>
    <input class="form-control" type="text" name="shipping_unique_code" id="shipping_unique_code" value="<?php echo e(isset($order->shipping_unique_code) ? $order->shipping_unique_code : old('shipping_unique_code')); ?>">

    <?php echo $errors->first('shipping_unique_code', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('shipping_tracking_code') ? 'has-error' : ''); ?>">
    <label for="shipping_tracking_code" class="control-label"><?php echo e('Tracking Code *'); ?></label>
    <input class="form-control" type="text" name="shipping_tracking_code" id="shipping_tracking_code" value="<?php echo e(isset($order->shipping_tracking_code) ? $order->shipping_tracking_code : old('shipping_tracking_code')); ?>">

    <?php echo $errors->first('shipping_tracking_code', '<p class="help-block">:message</p>'); ?>

</div><?php /**PATH /home/speedyorders/public_html/modban.com/Modules/AdminOrder/Resources/views/formelements/shippment.blade.php ENDPATH**/ ?>