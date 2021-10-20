<?php
    $layout =Modules\AdminRbac\Utils\RbacHelper::LAYOUT;
?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> Edit User
                    <span class="pull-right"><strong class="text-danger">*</strong> Required Fields</span>
                </h3>
            </div>

            <div class="panel-body">
                <form action="<?php echo e(route('users.update',$user->id)); ?>" method="POST" class="form-horizontal form-padding" enctype="multipart/form-data">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="admin-first-name">Full Name <span class="text-danger">*</span></label>
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
                            <label class="col-md-2 control-label" for="demo-address-input">Contact</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="contact" value="<?php echo e(old('contact',$user->contact)); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-address-input">Username <span class="text-danger">*</span></label>
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

                        <div class="form-group">
                            <label class="col-md-2 control-label">Roles <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <div class="checkbox">
                                    <?php if( count($groups) >0 ): ?>
                                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input id="group-<?php echo e($g->id); ?>" class="i-checks" type="checkbox" name="groups[]" value="<?php echo e($g->id); ?>" <?php echo e(in_array($g->id,$current_groups) ? "checked" : ''); ?>>
                                            <label for="group-<?php echo e($g->id); ?>" style="color: #000023;"><?php echo e($g->name); ?></label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <?php if($errors->has('groups')): ?>
                                    <small class="help-block text-danger">Please select at least one role</small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="demo-contact-input">Status</label>
                            <div class="col-md-9">
                                <div class="checkbox">
                                    <input id="status" class="i-checks" type="radio" name="status" value="1"
                                           <?php echo e($user->status ? 'checked' :''); ?>>
                                    <label for="status" class="text-left">Active</label>
                                    <span style="margin-left: 10px;"></span>
                                    <input id="status-2" class="i-checks" type="radio" name="status" value="0"
                                            <?php echo e($user->status == 0 ? 'checked' :''); ?>>
                                    <label for="status-2">Inactive</label>
                                </div>
                            </div>
                        </div>
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="form-group">
                            <label class="col-md-2"></label>
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

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/speedyorders/public_html/modban.com/Modules/AdminRbac/Providers/../Resources/views/users/edit.blade.php ENDPATH**/ ?>