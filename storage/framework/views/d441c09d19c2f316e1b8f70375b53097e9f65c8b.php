
<div class="form-group <?php echo e($errors->has('category_id') ? 'has-error' : ''); ?>">
    <label for="category_id" class="control-label"><?php echo e('Parent Category'); ?></label>
    <select name="category_id" class="form-control js-dropdown-select2" id="category_id" >
        <option value="">Select parent Category</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($optionValue->id); ?>" <?php echo e((isset($category->category_id) && $category->category_id == $optionValue->id) ? 'selected' : ''); ?>><?php echo e($optionValue->parentCategories); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php echo $errors->first('category_id', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
    <label for="name" class="control-label"><?php echo e('Name'); ?><span class="error">*</span></label>
    <input class="form-control" type="text" name="name" id="name" value="<?php echo e(old('name', isset($category->name) ? $category->name : null)); ?>" > </input>

    <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('slug') ? 'has-error' : ''); ?>">
    <label for="slug" class="control-label"><?php echo e('Slug'); ?></label>
    <input class="form-control" type="text" name="slug" id="slug" value="<?php echo e(old('slug', isset($category->slug) ? $category->slug : null)); ?>" > </input>

    <?php echo $errors->first('slug', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('image') ? 'has-error' : ''); ?>">
    <label for="image" class="control-label"><?php echo e('Image'); ?></label>
    <input type="file" name="image" class="form-control">
    <?php echo $errors->first('image', '<p class="help-block">:message</p>'); ?>


    <?php if(isset($category->image)  && $category->image!=''): ?>
        <br>
        <span id="categoryImage">
            <img width="250" src="<?php echo e(url('images/categories/'.$category->image)); ?>">    
        </span>
    <?php endif; ?>
</div>


<div class="form-group <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
    <label for="description" class="control-label"><?php echo e('Description'); ?><span class="error">*</span></label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" ><?php echo e(old('description', isset($category->description) ? $category->description : null)); ?></textarea>
    <?php echo $errors->first('description', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('return_policy') ? 'has-error' : ''); ?>">
    <label for="return_policy" class="control-label"><?php echo e('Return Policy'); ?><span class="error">*</span></label>
    <textarea class="form-control" rows="5" name="return_policy" type="textarea" id="return_policy" ><?php echo e(old('return_policy', isset($category->return_policy) ? $category->return_policy : null)); ?></textarea>
    <?php echo $errors->first('return_policy', '<p class="help-block">:message</p>'); ?>

</div>

<div class="form-group <?php echo e($errors->has('is_featured') ? 'has-error' : ''); ?>">
    <label for="is_featured" class="control-label"><?php echo e('Featured'); ?></label>
    <select name="is_featured" class="form-control js-dropdown-select2" id="is_featured" >
    <?php
        $is_featured = [1=>'Featured',0=>'Not-Featured'];
    ?>
    <?php $__currentLoopData = $is_featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($optionKey); ?>" <?php echo e((isset($category->is_featured) && $category->is_featured == $optionKey) ? 'selected' : ''); ?>><?php echo e($optionValue); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
    <?php echo $errors->first('is_featured', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('sort_order') ? 'has-error' : ''); ?>">
    <label for="sort_order" class="control-label"><?php echo e('Sort Order'); ?></label>
    <input class="form-control" type="text" name="sort_order" id="sort_order" value="<?php echo e(isset($category->sort_order) ? $category->sort_order : ''); ?>" > </input>

    <?php echo $errors->first('sort_order', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('show_on_homepage') ? 'has-error' : ''); ?>">
    <label for="show_on_homepage" class="control-label"><?php echo e('Show on Homepage'); ?></label>
    <select name="show_on_homepage" class="form-control js-dropdown-select2" id="show_on_homepage" >
    <?php
        $show_on_homepage = [1=>'Yes',0=>'No'];
    ?>
    <?php $__currentLoopData = $show_on_homepage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($optionKey); ?>" <?php echo e((isset($category->show_on_homepage) && $category->show_on_homepage == $optionKey) ? 'selected' : ''); ?>><?php echo e($optionValue); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
    <?php echo $errors->first('show_on_homepage', '<p class="help-block">:message</p>'); ?>

</div>


<div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
    <label for="status" class="control-label"><?php echo e('Status'); ?></label>
    <select name="status" class="form-control js-dropdown-select2" id="status" >
    <?php
        $status = [1=>'Active',0=>'Passive'];
    ?>
    <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($optionKey); ?>" <?php echo e((isset($category->status) && $category->status == $optionKey) ? 'selected' : ''); ?>><?php echo e($optionValue); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
    <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="<?php echo e($formMode === 'edit' ? 'Update' : 'Create'); ?>">
</div>
<?php /**PATH /home/speedyorders/public_html/modban.com/Modules/AdminCategory/Resources/views/form.blade.php ENDPATH**/ ?>