<?php $__env->startSection('content'); ?>
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Delivery Time List</h4>
            </div>
            <div class="col-md-1 pull-right text-right">
                <a href="<?php echo e(route('admin.deliverytime.create')); ?>" class="btn btn-primary-fade" data-toggle="tooltip" data-placement="top" data-original-title="Create Coupon">
                    <i class="fa fa-plus"></i>
                </a>
            </div>

        </div>
            <div class="table-responsive">
            <table id="deliverytimeTable" class="table table-bordered table-striped speedy-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Is Enabled</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $deliverytimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deliverytime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($deliverytime->name); ?></td>
                    <td>
                        <?php echo e($deliverytime->is_available=='1' ? 'Yes':'No'); ?>

                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.deliverytime.edit', $deliverytime->id )); ?>">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button data-toggle="modal" data-target="#delete-modal"
                        data-url="<?php echo e(route('admin.deliverytime.delete',$deliverytime->id)); ?>"
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
</div>
<?php echo $__env->make('commons.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ext_js'); ?>
    <script>
        $(document).ready(function() {
            $('#deliverytimeTable').DataTable({
                "pageLength" : 10
            });
        });

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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorder/Modules/AdminShipping/Resources/views/shippingdeliverytime/index.blade.php ENDPATH**/ ?>