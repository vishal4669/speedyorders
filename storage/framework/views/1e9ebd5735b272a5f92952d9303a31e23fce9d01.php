<?php $__env->startSection('content'); ?>
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Product List</h4>
            </div>
            <div class="col-md-1 pull-right text-right">

                <a href="<?php echo e(route('admin.products.import')); ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-original-title="Import">
                    <i class="fa fa-download"></i>
                </a>

                <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary-fade" data-toggle="tooltip" data-placement="top" data-original-title="Create Product">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="col-md-4 pull-right text-right">
                <form method="GET" action="<?php echo e(route('admin.products.index')); ?>" accept-charset="UTF-8" role="search">
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
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Return Policy</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($product->name); ?></td>
                    <td><?php echo e($product->sku); ?></td>
                    <td><?php echo e($product->base_price); ?></td>
                    <td><?php echo e($product->quantity); ?></td>
                    <td><?php echo e(($product->return_policy_days) ? $product->return_policy_days.' Days': ''); ?></td>
                    <td>
                        <?php echo e($product->status=='1' ? 'Active':'Inactive'); ?>

                        <a href="<?php echo e(route('admin.products.update.status',$product->id)); ?>" class="text-danger"><strong>Change</strong></a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.products.edit', $product->id )); ?>">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button data-toggle="modal" data-target="#delete-modal"
                        data-url="<?php echo e(route('admin.products.delete',$product->id)); ?>"
                        class="btn btn-danger delete">
                        <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tfoot>
                    <tr>
                        <td class="text-center" colspan="6">
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorders/Modules/AdminProduct/Resources/views/index.blade.php ENDPATH**/ ?>