<div class="form-group">
    <?php if(old('galleryId')): ?>
        <input type="hidden" value="<?php echo e(old('galleryId')); ?>" id="oldGalleryId"></span>
    <?php endif; ?>
    <h4>Gallery Images</h4>
    <form action="<?php echo e(route('admin.products.upload.media')); ?>" method="POST" id="uploadProductMediaForm">
        <?php echo csrf_field(); ?>
        <table id="gallery-table"
            class="footable table table-stripped table-bordered toggle-arrow-tiny default breakpoint footable-loaded"
            data-page-size="8" data-filter="#filter">

            <thead>
                <tr>
                    <?php if(old('galleryId')==null): ?>
                    <th class="footable-visible">Image</span></th>
                    <th class="footable-visible">Sort order</span></th>
                    <?php endif; ?>
                    <th class="footable-sortable">Action</span></th>
                </tr>
            </thead>

            <tbody id="galleryBody">
                    <?php if(isset($productGalleries)): ?>
                    <?php $__currentLoopData = $productGalleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id='<?php echo e($productImage->id); ?>' style='display: table-row;' class='footable-even'>
                            <td class='footable-visible footable-first-column'>
                                <img src="<?php echo e(asset('images/products/'.$productImage->image)); ?>" alt="" style="width:100px;">
                            </td>
                            <td class='footable-visible'>
                                <?php echo e($productImage->order); ?>

                            </td>
                            <td class='footable-visible footable-last-column'>
                                <button type='button' class='btn btn-danger deleteGalleryImage'><i class='fa fa-trash'></i> </button>
                                <button type='button' class='btn btn-danger editGalleryImage'><i class='fa fa-pencil'></i> </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
            </tbody>

            <tfoot>
                <tr style="display: table-row;" class="footable-even">
                    <td class="footable-visible footable-first-column"></td>
                    <td class="footable-visible">
                        <button type="submit" class="btn btn-primary" id="uploadImagesBtn">Upload Images</button>
                    </td>
                    <td class="footable-visible footable-last-column">
                        <button type="button" id="addGalleryImage" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </td>
                </tr>
            </tfoot>

        </table>
    </form>

</div>




 
<?php /**PATH /var/www/html/speedyorders/Modules/AdminProduct/Resources/views/forms/gallery.blade.php ENDPATH**/ ?>