<?php $__env->startSection('content'); ?>
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Option List</h4>
            </div>
            <div class="col-md-1 pull-right text-right">
                <a href="<?php echo e(route('admin.product.options.create')); ?>" class="btn btn-primary-fade" data-toggle="tooltip" data-placement="top" data-original-title="Create Product">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="col-md-1 pull-right text-right">
                <button data-toggle="modal" data-target="#option-modal"
                    class="btn btn-secondary">
                    <i class="fa fa-download"></i>
                </button>
            </div>
            <div class="col-md-4 pull-right text-right">
                <form method="GET" action="<?php echo e(route('admin.product.options.index')); ?>" accept-charset="UTF-8" role="search">
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
                        <th>Name</th><th>Type</th><th>Options</th><th>Sort Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($item->name); ?></td>
                            <td><?php echo e($item->type); ?></td>
                            <td><?php echo $item->optionValues->sortBy('sort_order')->pluck('name')->implode(",<br>"); ?></td>
                            <td><?php echo e($item->sort_order); ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.product.options.edit', $item->id  )); ?>">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button data-toggle="modal" data-target="#delete-modal"
                                    data-url="<?php echo e(route('admin.product.options.delete',$item->id)); ?>"
                                    class="btn btn-danger delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td class="text-center" colspan="6">
                            <span>No data available in the table...</span>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tfoot>
                        <tr>
                            <td class="text-center" colspan="6">
                                <span><?php echo $options->render(); ?></span>
                            </td>
                        </tr>
                    </tfoot>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php echo $__env->make('commons.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="modal" id="option-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6><strong>Make sure that excel is according to provided sample?</strong>
                    <a href="<?php echo e(storage_path('/excel-sample/faq.xlsx')); ?>"><strong>sample found here</strong></a>
                </h6>
            </div>
            <form action="<?php echo e(route('admin.product.options.import')); ?>" id="option-form" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <input type="file" class="form-control" name="option_file" id="option-file">
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" id="option-modal-submit">Yes</button>
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

        $(document).on('click', '#option-modal-submit', function () {
          
                $(this).attr('disabled', true);
                $(this).html('<i class="fa fa-spinner fa-spin" style=""></i> Please Wait...');
               $('#option-form').submit();
            
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorder/Modules/AdminProductOption/Resources/views/index.blade.php ENDPATH**/ ?>