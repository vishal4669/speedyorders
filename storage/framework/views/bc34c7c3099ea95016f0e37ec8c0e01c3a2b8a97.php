<?php $__env->startSection('content'); ?>
<?php echo $__env->make('adminorder::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Orders List</h4>
            </div>
            <div class="col-md-1 pull-right text-right">
                <a href="<?php echo e(route('admin.orders.create')); ?>" class="btn btn-primary-fade" data-toggle="tooltip" data-placement="top" data-original-title="Create Product">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="col-md-4 pull-right text-right">
                <form method="GET" action="<?php echo e(route('admin.orders.index')); ?>" accept-charset="UTF-8" role="search">
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
                        <th>#</th>
                        <th>Order Id</th>
                        <th>Customer User</th>
                        <th>Invoice Number</th>
                        <th>Invoice Prefix</th>
                        <th>First Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $firstname = (isset($item->customerUser->customer->first_name)) ? $item->customerUser->customer->first_name : '';
                            $last_name = (isset($item->customerUser->customer->last_name)) ? $item->customerUser->customer->last_name : '';
                            $name = $firstname." ".$last_name;
                        ?>

                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($item->uuid); ?></td>
                            <td><?php echo e($name); ?></td>                            
                            <td><?php echo e($item->invoice_number); ?></td>
                            <td><?php echo e($item->invoice_prefix); ?></td>
                            <td><?php echo e($item->first_name); ?></td>
                            <td>
                                <?php echo e($item->status=='1' ? 'Active':'Inactive'); ?>

                                <a href="<?php echo e(route('admin.orders.update.status',$item->id)); ?>" class="text-danger"><strong>Change</strong></a>
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm" title="process" href="<?php echo e(route('admin.orders.process', $item->id  )); ?>">
                                    <i class="fa fa-tasks"></i>
                                </a>

                                <a class="btn btn-primary btn-sm" title="view" href="<?php echo e(route('admin.orders.show', $item->id  )); ?>">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a class="btn btn-success btn-sm"  title="report" href="<?php echo e(route('admin.orders.invoices.show', $item->id  )); ?>">
                                    <i class="fa fa-file"></i>
                                </a>
                                <a class="btn btn-primary btn-sm" title="edit" href="<?php echo e(route('admin.orders.edit', $item->id  )); ?>">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button data-toggle="modal"  title="delete" data-target="#delete-modal"
                                    data-url="<?php echo e(route('admin.orders.delete',$item->id)); ?>"
                                    class="btn btn-danger delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td class="text-center" colspan="7">
                            <span>No data available in the table...</span>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tfoot>
                        <tr>
                            <td class="text-center" colspan="7">
                                <span><?php echo $orders->render(); ?></span>
                            </td>
                        </tr>
                    </tfoot>
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorders/Modules/AdminOrder/Resources/views/index.blade.php ENDPATH**/ ?>