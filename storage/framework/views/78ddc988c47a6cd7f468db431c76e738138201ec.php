<?php
    $layout =Modules\AdminRbac\Utils\RbacHelper::LAYOUT;
?>


<?php $__env->startSection('content'); ?>
    <div class="hpanel">
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="<?php echo e(route('users')); ?>" aria-expanded="true"><strong>Users</strong></a></li>
                <li class=""><a href="<?php echo e(route('groups')); ?>" aria-expanded="false">Groups</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div class="row">
                            <?php echo $__env->make('adminrbac::users.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="col-md-4 text-right">
                                <a href="<?php echo e(route('users.create')); ?>" class="btn btn-success">ADD NEW <i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped gds-table">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>User Roles</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <?php
                                            $groups = $user->groups->pluck('name')->toArray();
                                        ?>
                                        <td><strong><?php echo e(join(' | ', $groups)); ?></strong></td>
                                        <td><?php echo e($user->full_name); ?></td>
                                        <td><?php echo e($user->username); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e($user->contact); ?></td>
                                        <td>
                                            <?php if($user->isSuperAdmin->count() == 0): ?>
                                                <?php if($user->status): ?>
                                                    <span class="label label-success">Active</span> <a
                                                        href="<?php echo e(route('users.status',$user->id)); ?>"
                                                        class="text-danger"><strong>Change</strong></a>
                                                <?php else: ?>
                                                    <span class="label label-warning">In-Active</span> <a
                                                        href="<?php echo e(route('users.status',$user->id)); ?>"
                                                        class="text-danger"><strong>Change</strong></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(auth()->guard('admin')->user()): ?>
                                                <?php if($user->isSuperAdmin->count() == 0): ?>
                                                    <a href="<?php echo e(route('users.edit',[$user->id])); ?>"
                                                       class="btn btn-info">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button data-toggle="modal" data-target="#password-modal"
                                                            class="btn btn-success password" title="change password"
                                                            data-url="<?php echo e(route('users.reset-password',$user->id)); ?>">
                                                        <i class="fa fa-lock"></i>
                                                    </button>
                                                    <button data-toggle="modal" data-target="#delete-modal"
                                                            data-url="<?php echo e(route('users.delete',$user->id)); ?>"
                                                            class="btn btn-danger delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No data available in the table ...</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="8"><?php echo e($users->appends(request()->all())->links()); ?></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('commons.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="modal" id="password-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="pass-form" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h4>Reset Password</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" id="new-pass" name="new_password" class="form-control"
                                   placeholder="*******" required="required">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="pw-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ext_js'); ?>
    <script>
        $(document).on('click', '.delete', function () {
            var actionUrl = $(this).attr('data-url');

            $('#delete-form').attr('action', actionUrl);

            $('#modal-submit').click(function (e) {
                $(this).attr('disabled', true);
                $(this).html('<i class="fa fa-spinner fa-spin" style=""></i> Please Wait...');
                $('#delete-form').submit();
            })
        });

        $(document).on('click', '.password', function () {
            var actionUrl = $(this).attr('data-url');

            $('#pass-form').attr('action', actionUrl);


            $('#pw-submit').click(function (e) {
                var newPass = $('#new-pass').val();

                if (newPass && newPass.length > 6) {
                    $(this).attr('disabled', true);
                    $(this).html('<i class="fa fa-spinner fa-spin" style=""></i> Please Wait...');
                    $('#pass-form').submit();
                } else {
                    $('#new-pass').parent().addClass('has-error');
                    $('#new-pass').next('.help-block').remove();
                    $('#new-pass').after('<span class="help-block">Password must be at least 6 character length.</span>');
                    e.preventDefault();
                }
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/speedyorders/public_html/modban.com/Modules/AdminRbac/Providers/../Resources/views/users/index.blade.php ENDPATH**/ ?>