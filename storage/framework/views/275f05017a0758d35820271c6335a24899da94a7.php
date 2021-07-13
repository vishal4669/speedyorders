<?php if(session('insufficient_product_quantity')): ?>
<div class="alert alert-danger alert-dismissable">
    <button class="close" data-dismiss="alert"><i class="fa fa-times-circle"></i></button>
    <strong><i class="fa fa-check"></i></strong> <?php echo Session::get('insufficient_product_quantity'); ?>

</div>
<?php elseif(session('invalid_coupon')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button class="close" data-dismiss="alert"><i class="fa fa-times-circle"></i></button>
        <strong><i class="fa fa-warning"></i></strong> <?php echo Session::get('invalid_coupon'); ?>

    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/speedyorders/Modules/AdminOrder/Resources/views/message.blade.php ENDPATH**/ ?>