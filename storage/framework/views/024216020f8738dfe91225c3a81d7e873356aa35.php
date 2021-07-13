<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label> <input type="checkbox" name="categories[]" id="<?php echo e($category->id); ?>"
                        value="<?php echo e($category->id); ?>"
                        <?php echo e(in_array($category->id, $productCategories) ? 'checked' : ''); ?>>
                    <?php echo e($category->name); ?> </label>
                <?php $__empty_1 = true; $__currentLoopData = $category->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="container">
                        <label class="">
                            <input type="checkbox" name="categories[]" id="<?php echo e($item->id); ?>"
                                value="<?php echo e($item->id); ?>"
                                <?php echo e(in_array($item->id, $productCategories) ? 'checked' : ''); ?>>
                            <?php echo e($item->name); ?>

                        </label>
                        <?php $__empty_2 = true; $__currentLoopData = $item->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                            <div class="container">
                                <label>
                                    <input type="checkbox" name="categories[]" id="<?php echo e($datum->id); ?>"
                                        value="<?php echo e($datum->id); ?>"
                                        <?php echo e(in_array($datum->id, $productCategories) ? 'checked' : ''); ?>>
                                    <?php echo e($datum->name); ?> </label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <br>
    <div class="row">
        <div class="col-md-12">
            <div class="boxed">
                <div class="boxed-wrapper">
                    <div class="hpanel">
                        <div class="panel-heading">
                            <h5><strong>Product Images</strong> </h5>
                        </div>
                        <div class="panel-body">
                            <?php echo $__env->make('adminproduct::forms.gallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php /**PATH /var/www/html/speedyorders/Modules/AdminProduct/Resources/views/forms/category.blade.php ENDPATH**/ ?>