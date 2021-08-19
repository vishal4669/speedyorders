<div class="hr-line-dashed"></div>

            <input type="hidden" name="galleryId" value="<?php echo e(old('galleryId')); ?>" id="galleryId">

            <div class="row">
                <label class=" col-md-2 control-label">SKU<span class="error">*</span></label>
                <div class="col-md-8">
                    <input type="text" name="sku" value="<?php echo e(old('sku', isset($product) ? $product->sku : null)); ?>"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Product Name<span class="error">*</span></label>
                <div class="col-md-8">
                    <input type="text" name="name" value="<?php echo e(old('name', isset($product) ? $product->name : null)); ?>"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Product Height</label>
                <div class="col-md-8">
                    <input type="number" name="height"
                        value="<?php echo e(old('height', isset($product) ? $product->height : null)); ?>" class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Product Width</label>
                <div class="col-md-8">
                    <input type="number" name="width"
                        value="<?php echo e(old('width', isset($product) ? $product->width : null)); ?>" class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Product Length</label>
                <div class="col-md-8">
                    <input type="number" name="length"
                        value="<?php echo e(old('length', isset($product) ? $product->length : null)); ?>" class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Product Breadth</label>
                <div class="col-md-8">
                    <input type="number" name="breadth"
                        value="<?php echo e(old('breadth', isset($product) ? $product->breadth : null)); ?>" class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Product Main Image<span class="error">*</span></label>
                <div class="col-md-8">
                    <input type="file" name="image" class="form-control"
                        value="old('image',isset($product)?$product->image:null)">
                </div>
            </div>

            <?php if(isset($product->image) && $product->image!=''): ?>
                <div class="row">
                    <label class="col-md-2 control-label"></label>
                    <div class="col-md-8">
                        <img src="<?php echo e(url('images/products/'.$product->image)); ?>" width="200px">
                    </div>
                </div>
            <?php endif; ?>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Product Video</label>
                <div class="col-md-8">
                    <input type="text" name="video"
                        value="<?php echo e(old('video', isset($product) ? $product->video : null)); ?>" class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Product Description<span class="error">*</span></label>
                <div class="col-md-8">
                    <textarea name="description" id="product-description" cols="85"
                        rows="3"> <?php echo e(old('description', isset($product) ? $product->description : null)); ?> </textarea>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Base Price<span class="error">*</span></label>
                <div class="col-md-8">
                    <input type="text" name="base_price"
                        value="<?php echo e(old('base_price', isset($product) ? $product->base_price : null)); ?>" class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Sale Price<span class="error">*</span></label>
                <div class="col-md-8">
                    <input type="text" name="sale_price"
                        value="<?php echo e(old('sale_price', isset($product) ? $product->sale_price : null)); ?>" class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Product Quantity<span class="error">*</span></label>
                <div class="col-md-8">
                    <input type="text" name="quantity"
                        value="<?php echo e(old('quantity', isset($product) ? $product->quantity : null)); ?>"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Product Minimum Quantity<span class="error">*</span></label>
                <div class="col-md-8">
                    <input type="text" name="min_quantity"
                        value="<?php echo e(old('min_quantity', isset($product) ? $product->min_quantity : null)); ?>"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Sort Order<span class="error">*</span></label>
                <div class="col-md-8">
                    <input type="number" name="sort_order"
                        value="<?php echo e(old('sort_order', isset($product) ? $product->sort_order : null)); ?>"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Publish Status</label>
                <div class="col-md-8">
                    <select class="form-control m-b js-dropdown-select2" name="status">
                        <option value="1" <?php if(old('status', isset($product) ? $product->status : null) == 1): ?> selected <?php endif; ?>>Yes</option>
                        <option value="0" <?php if(old('status', isset($product) ? $product->status : null) == 0): ?> selected <?php endif; ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Featured</label>
                <div class="col-md-8">
                    <select class="form-control m-b js-dropdown-select2" name="is_featured">
                        <option value="1" <?php if(old('is_featured', isset($product) ? $product->is_featured : null) == 1): ?> selected <?php endif; ?>>Yes</option>
                        <option value="0" <?php if(old('is_featured', isset($product) ? $product->is_featured : null) == 0): ?> selected <?php endif; ?>>No</option>
                    </select>
                </div>
            </div>


            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Subtract From Stock</label>
                <div class="col-md-8">
                    <select class="form-control m-b js-dropdown-select2" name="subtract_stock">
                        <option value="1" <?php if(old('subtract_stock', isset($product) ? $product->subtract_stock : null) == 1): ?> selected <?php endif; ?>>Yes</option>
                        <option value="0" <?php if(old('subtract_stock', isset($product) ? $product->subtract_stock : null) == 0): ?> selected <?php endif; ?>>No</option>
                    </select>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Meta Title</label>
                <div class="col-md-8">
                    <input type="text" name="meta_title"
                        value="<?php echo e(old('meta_title', isset($product) ? $product->meta_title : null)); ?>"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Meta Description</label>
                <div class="col-md-8">
                    <textarea name="meta_description" id="" cols="85"
                        rows="3"> <?php echo e(old('meta_description', isset($product) ? $product->meta_description : null)); ?> </textarea>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Meta Keywords</label>
                <div class="col-md-8">
                    <textarea name="meta_keywords" id="" cols="85"
                        rows="3"> <?php echo e(old('meta_keywords', isset($product) ? $product->meta_keywords : null)); ?> </textarea>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="row">
                <label class="col-md-2 control-label">Return Policy</label>
                <div class="col-md-8">
                    <input name="return_policy_days" type="number" placeholder="Number Of Days" value="<?php echo e(old('return_policy_days', isset($product) ? $product->return_policy_days : null)); ?>" />
                </div>
            </div>

<script src="<?php echo e(asset('/vendor/ckeditor/ckeditor.js')); ?>"></script>

<script>
    CKEDITOR.replace( 'product-description' );
</script><?php /**PATH /var/www/html/speedyorders/Modules/AdminProduct/Resources/views/forms/general.blade.php ENDPATH**/ ?>