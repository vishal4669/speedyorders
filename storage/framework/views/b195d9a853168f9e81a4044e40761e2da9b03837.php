<?php if(session('success_message')): ?>
    <div class="alert alert-success alert-dismissable">
        <button class="close" data-dismiss="alert"><i class="fa fa-times-circle"></i></button>
        <strong><i class="fa fa-check"></i></strong> <?php echo Session::get('success_message'); ?>

    </div>
<?php elseif(session('error_message')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button class="close" data-dismiss="alert"><i class="fa fa-times-circle"></i></button>
        <strong><i class="fa fa-warning"></i></strong> <?php echo Session::get('error_message'); ?>

    </div>
<?php endif; ?>
<?php /**PATH /home/speedyorders/public_html/modban.com/resources/views/commons/flash.blade.php ENDPATH**/ ?>