<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php echo $__env->make('adminsetting::sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Company Information</h4>
                </div>
                <div class="panel-body">
                    <form action="<?php echo e(route('admin.settings')); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group<?php echo e($errors->has('company_name') ? ' has-error' :''); ?>">
                            <label for="">Company/Agency Name</label>
                            <input type="text" name="company_name" id="" class="form-control" value="<?php echo e(Option::get('company_name')); ?>">
                            <?php if($errors->has('company_name')): ?>
                                <span class="help-block"><?php echo e($errors->first('company_name')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group<?php echo e($errors->has('company_address') ? ' has-error' :''); ?>">
                            <label for="">Address Line</label>
                            <input type="text" name="company_address" id="" class="form-control" value="<?php echo e(Option::get('company_address')); ?>">
                            <?php if($errors->has('company_address')): ?>
                                <span class="help-block"><?php echo e($errors->first('company_address')); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6<?php echo e($errors->has('company_email') ? ' has-error' :''); ?>">
                                <label for="">Email(CSD)</label>
                                <input type="text" name="company_email" id="" class="form-control" value="<?php echo e(Option::get('company_email')); ?>">
                                <?php if($errors->has('company_email')): ?>
                                    <span class="help-block"><?php echo e($errors->first('company_email')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-6<?php echo e($errors->has('company_phone') ? ' has-error' :''); ?>">
                                <label for="">Phone</label>
                                <input type="text" name="company_phone" id="" class="form-control" value="<?php echo e(Option::get('company_phone')); ?>">
                                <?php if($errors->has('company_phone')): ?>
                                    <span class="help-block"><?php echo e($errors->first('company_phone')); ?></span>
                                <?php endif; ?>
                            </div>

                             <div class="form-group col-md-6<?php echo e($errors->has('site_logo') ? ' has-error' :''); ?>">
                                <label for="">Site Logo</label>
                                <input type="file" name="site_logo" class="form-control" value="<?php echo e(Option::get('site_logo')); ?>">
                                <?php if($errors->has('site_logo')): ?>
                                    <span class="help-block"><?php echo e($errors->first('site_logo')); ?></span>
                                <?php endif; ?>
                            </div>

                            <?php if(Option::get('site_logo')!=''): ?>
                                <div class="form-group col-md-6">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-8">
                                        <img src="<?php echo e(url('images/'.Option::get('site_logo'))); ?>" width="200px">
                                    </div>
                                </div>
                            <?php endif; ?>


                        </div>

                        <div class="col-md-12 text-right">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/speedyorders/public_html/modban.com/Modules/AdminSetting/Resources/views/index.blade.php ENDPATH**/ ?>