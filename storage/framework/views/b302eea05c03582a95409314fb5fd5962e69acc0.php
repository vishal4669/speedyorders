        <div class="form-group">
            <label class="control-label">Choose Existing Customer</label>
                <select name="customer_user_id" class="form-control js-dropdown-select2" id="customer_id">
                    <option value="" selected>Select any customer</option>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($customer->id); ?>" <?php echo e(isset($order)?($order->customer_user_id == $customer->id)?'selected':'':''); ?>><?php echo e($customer->email); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
        </div>

        <div class="form-group <?php echo e($errors->has('user_email') ? 'has-error' : ''); ?>">
            <label class="control-label">New User Email</label>
            <input class="form-control" type="text" name="user_email" id="user_email" value="<?php echo e(isset($order->user_email) ? $order->user_email : old('user_email')); ?>">
            <?php echo $errors->first('user_email', '<p class="help-block">:message</p>'); ?>

        </div>

        <div class="form-group <?php echo e($errors->has('invoice_number') ? 'has-error' : ''); ?>">
            <label for="invoice_number" class="control-label"><?php echo e('Invoice Number *'); ?></label>
            <input class="form-control" type="text" name="invoice_number" id="invoice_number" value="<?php echo e(isset($order->invoice_number) ? $order->invoice_number : \Str::random(10)); ?>" readonly>
            <?php echo $errors->first('invoice_number', '<p class="help-block">:message</p>'); ?>

        </div>
        <div class="form-group <?php echo e($errors->has('invoice_prefix') ? 'has-error' : ''); ?>">
            <label for="invoice_prefix" class="control-label"><?php echo e('Invoice Prefix *'); ?></label>
            <input class="form-control" type="text" name="invoice_prefix" id="invoice_prefix" value="<?php echo e(isset($order->invoice_prefix) ? $order->invoice_prefix : old("invoice_prefix")); ?>">

            <?php echo $errors->first('invoice_prefix', '<p class="help-block">:message</p>'); ?>

        </div>
        <div class="form-group <?php echo e($errors->has('first_name') ? 'has-error' : ''); ?>">
            <label for="first_name" class="control-label"><?php echo e('First Name *'); ?></label>
            <input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo e(isset($order->first_name) ? $order->first_name : old('first_name')); ?>">

            <?php echo $errors->first('first_name', '<p class="help-block">:message</p>'); ?>

        </div>
        <div class="form-group <?php echo e($errors->has('last_name') ? 'has-error' : ''); ?>">
            <label for="last_name" class="control-label"><?php echo e('Last Name *'); ?></label>
            <input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo e(isset($order->last_name) ? $order->last_name : old('last_name')); ?>">

            <?php echo $errors->first('last_name', '<p class="help-block">:message</p>'); ?>

        </div>
        <div class="form-group <?php echo e($errors->has('address_1') ? 'has-error' : ''); ?>">
            <label for="address_1" class="control-label"><?php echo e('Address1 *'); ?></label>
            <input class="form-control" type="text" name="address_1" id="address_1" value="<?php echo e(isset($order->address_1) ? $order->address_1 : old('address_1')); ?>">

            <?php echo $errors->first('address_1', '<p class="help-block">:message</p>'); ?>

        </div>
        <div class="form-group <?php echo e($errors->has('address_2') ? 'has-error' : ''); ?>">
            <label for="address_2" class="control-label"><?php echo e('Address2'); ?></label>
            <input class="form-control" type="text" name="address_2" id="address_2" value="<?php echo e(isset($order->address_2) ? $order->address_2 : old('address_2')); ?>">

            <?php echo $errors->first('address_2', '<p class="help-block">:message</p>'); ?>

        </div>
        <div class="form-group <?php echo e($errors->has('city') ? 'has-error' : ''); ?> ">
            <label for="city" class="control-label"><?php echo e(' City '); ?></label>
            <input class="form-control" type="text" name="city" id="city" value="<?php echo e(isset($order->city) ? $order->city : old('city')); ?>">

            <?php echo $errors->first('city', '<p class="help-block">:message</p>'); ?>

        </div>

        <div class="form-group <?php echo e($errors->has('country_name') ? 'has-error' : ''); ?>">
            <label for="country_name" class="control-label"><?php echo e(' Country '); ?></label>
            <input class="form-control" type="text" name="country_name" id="country_name" value="<?php echo e(isset($order->country_name) ? $order->country_name : old('country_name')); ?>">

            <?php echo $errors->first('country_name', '<p class="help-block">:message</p>'); ?>

        </div>

        <div class="form-group <?php echo e($errors->has('postcode') ? 'has-error' : ''); ?>">
            <label for="postcode" class="control-label"><?php echo e('Post Code *'); ?></label>
            <input class="form-control" type="text" name="postcode" id="postcode" value="<?php echo e(isset($order->postcode) ? $order->postcode : old('postcode')); ?>">

            <?php echo $errors->first('postcode', '<p class="help-block">:message</p>'); ?>

        </div>

        <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
            <label for="email" class="control-label"><?php echo e('Email *'); ?></label>
            <input class="form-control" type="text" name="email" id="email" value="<?php echo e(isset($order->email) ? $order->email : old('email')); ?>">

            <?php echo $errors->first('email', '<p class="help-block">:message</p>'); ?>

        </div>
        
        <div class="form-group <?php echo e($errors->has('phone') ? 'has-error' : ''); ?>">
            <label for="phone" class="control-label"><?php echo e('Phone *'); ?></label>
            <input class="form-control" type="text" name="phone" id="phone" value="<?php echo e(isset($order->phone) ? $order->phone : old('phone')); ?>">

            <?php echo $errors->first('phone', '<p class="help-block">:message</p>'); ?>

        </div><?php /**PATH /home/speedyorders/public_html/modban.com/Modules/AdminOrder/Resources/views/formelements/general.blade.php ENDPATH**/ ?>