<?php $__env->startSection('content'); ?>

    <div class="login-container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center m-b-md">
                    <h3>LOGIN</h3>
                </div>
                <div class="text-center m-b-md">
                    <?php if(Session::has('error_message')): ?>
                        <div class="alert alert-danger">
                            <strong><?php echo e(Session::get('error_message')); ?></strong>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="hpanel">
                    <div class="panel-body">
                        <form action="<?php echo e(route('admin.login.submit')); ?>" method="post" id="loginForm">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" placeholder="example@gmail.com" class="form-control <?php echo e($errors->first('username') ? 'error' : ''); ?>" title="Please enter you username" required="" value="<?php echo e(isset($admin_rem_username) && $admin_rem_username !="" ? $admin_rem_username :old('username')); ?>" name="username" id="username" >
                                <?php if($errors->first('username')): ?>
                                    <label id="-error" class="error" for="">Please enter a valid email address.</label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="<?php echo e(isset($admin_rem_password) && $admin_rem_password !="" ? $admin_rem_password : old('password')); ?>" name="password" id="password" class="form-control">
                                <?php if($errors->first('password')): ?>
                                    <label id="-error" class="error" for="">Please enter a valid password.</label>
                                <?php endif; ?>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" class="i-checks" name="remember_me" <?php echo e((isset($admin_rem_password) && $admin_rem_password !="") && (isset($admin_rem_username) && $admin_rem_username !="") ?'checked' :''); ?>>
                                Remember login
                            </div>
                            <button class="btn btn-success btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlogin::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorders/Modules/AdminLogin/Providers/../Resources/views/index.blade.php ENDPATH**/ ?>