<?php $__env->startSection('content'); ?>
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Customer List</h4>
            </div>
            <div class="col-md-1 pull-right text-right">
                <a href="<?php echo e(route('admin.customers.create')); ?>" class="btn btn-primary-fade" data-toggle="tooltip" data-placement="top" data-original-title="Create Customers">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="col-md-4 pull-right text-right">
                <form method="GET" action="<?php echo e(route('admin.customers.index')); ?>" accept-charset="UTF-8" role="search">
                    <div class="input-group"><input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                                <button type="button" class="btn btn-primary-fade"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>

        </div>
            <div class="table-responsive">
            <table id="productTable" class="table table-bordered table-striped speedy-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Newsletter</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($customer->first_name.' '.$customer->last_name); ?></td>
                    <td><?php echo e($customer->email); ?></td>
                    <td><?php echo e($customer->telephone); ?></td>
                    <td><?php echo e($customer->newsletter); ?></td>
                    <td>
                        <?php echo e($customer->status=='1' ? 'Active':'Inactive'); ?>

                        <a href="<?php echo e(route('admin.customers.update.status',$customer->id)); ?>" class="text-danger"><strong>Change</strong></a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.customers.edit', $customer->id )); ?>">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button data-toggle="modal" data-target="#delete-modal"
                        data-url="<?php echo e(route('admin.customers.delete',$customer->id)); ?>"
                        class="btn btn-danger delete">
                        <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tfoot>
                    <tr>
                        <td class="text-center" colspan="10">
                            <span>No data available in the table...</span>
                        </td>
                    </tr>
                </tfoot>
                <?php endif; ?>
            </tbody>
            </table>
            </div>
        </div>
    </div>
<?php echo $__env->make('commons.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/speedyorders/public_html/modban.com/Modules/AdminCustomer/Resources/views/index.blade.php ENDPATH**/ ?>