<div class="col-md-3">
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="<?php echo e(route('admin.settings')); ?>" class="<?php echo e(isset($sub_menu) && $sub_menu == 'general' ? 'text-bold' : ''); ?>">General Setting</a>
                </li>
                <li class="list-group-item">
                    <a href="<?php echo e(route('admin.settings.cod')); ?>" class="<?php echo e(isset($sub_menu) && $sub_menu == 'cod' ? 'text-bold' : ''); ?>">Cash On Delivery Setting</a>
                </li>
                <li class="list-group-item">
                    <a href="<?php echo e(route('admin.settings.paypal')); ?>" class="<?php echo e(isset($sub_menu) && $sub_menu == 'paypal' ? 'text-bold' : ''); ?>">Paypal Setting</a>
                </li>
                <li class="list-group-item">
                    <a href="<?php echo e(route('admin.settings.stripe')); ?>" class="<?php echo e(isset($sub_menu) && $sub_menu == 'stripe' ? 'text-bold' : ''); ?>">Stripe Setting</a>
                </li>
                <li class="list-group-item">
                    <a href="<?php echo e(route('admin.settings.shipping')); ?>" class="<?php echo e(isset($sub_menu) && $sub_menu == 'shipping' ? 'text-bold' : ''); ?>">Shipping Setting</a>
                </li>
                <li class="list-group-item">
                    <a href="<?php echo e(route('admin.settings.chat')); ?>" class="<?php echo e(isset($sub_menu) && $sub_menu == 'chat' ? 'text-bold' : ''); ?>">Chat Setting</a>
                </li>
                <li class="list-group-item">
                    <a href="<?php echo e(route('admin.settings.googleanalytics')); ?>" class="<?php echo e(isset($sub_menu) && $sub_menu == 'googleanalytics' ? 'text-bold' : ''); ?>">Google Analytics Setting</a>
                </li>
                <li class="list-group-item">
                    <a href="<?php echo e(route('admin.settings.socialmedia')); ?>" class="<?php echo e(isset($sub_menu) && $sub_menu == 'socialmedia' ? 'text-bold' : ''); ?>">Social Media Setting</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH /home/speedyorders/public_html/modban.com/Modules/AdminSetting/Resources/views/sidebar.blade.php ENDPATH**/ ?>