<?php
    $layout =Modules\AdminRbac\Utils\RbacHelper::LAYOUT;
?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> user profile
                    <span class="pull-right"><strong class="text-danger">*</strong> Required Fields</span>
                </h3>
            </div>

            <div class="panel-body">
                <form action="<?php echo e(route('users.profile')); ?>" method="POST" class="form-horizontal form-padding" enctype="multipart/form-data">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="admin-first-name">Full Name <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="admin-first-name" name="first_name" class="form-control" value="<?php echo e(old('first_name',$user->first_name)); ?>" placeholder="First Name" >
                                <small class="help-block text-danger"><?php echo e($errors->first('first_name')); ?></small>
                            </div>
                            <div class="col-md-5">
                                <input type="text" id="admin-last-name" name="last_name" class="form-control" value="<?php echo e(old('last_name', $user->last_name)); ?>" placeholder="Last Name" >
                                <small class="help-block text-danger"><?php echo e($errors->first('last_name')); ?></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="demo-address-input">Contact</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="contact" value="<?php echo e(old('contact',$user->contact)); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="demo-address-input">Username <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="username" value="<?php echo e(old('username',$user->username)); ?>">
                                <small class="help-block text-danger"><?php echo e($errors->first('username')); ?></small>
                            </div>
                            <label class="col-md-1 control-label" for="demo-address-input">Email<span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="email" value="<?php echo e(old('email',$user->email)); ?>">
                                <small class="help-block text-danger"><?php echo e($errors->first('email')); ?></small>
                            </div>
                        </div>
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-block btn-info" name="submit" value="UPDATE">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/speedyorders/public_html/modban.com/Modules/AdminRbac/Providers/../Resources/views/users/profile.blade.php ENDPATH**/ ?>