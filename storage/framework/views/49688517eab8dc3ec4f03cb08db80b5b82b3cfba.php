<div class="form-group <?php echo e($errors->has('parent_id') ? 'has-error' : ''); ?>">
    <label for="parent_id" class="control-label"><?php echo e('Parent Id'); ?></label>

    <select name="parent_id" class="form-control js-dropdown-select2" id="parent_id">
        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($optionValue->id); ?>" <?php echo e((isset($adminpage->parent_id) && $adminpage->parent_id == $optionValue->id) ? 'selected' : ''); ?>><?php echo e($optionValue->title); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php echo $errors->first('parent_id', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('slug') ? 'has-error' : ''); ?>">
    <label for="slug" class="control-label"><?php echo e('Slug'); ?></label>
    <input class="form-control" type="text" name="slug" id="slug" value="<?php echo e(isset($adminpage->slug) ? $adminpage->slug : ''); ?>" required> </input>

    <?php echo $errors->first('slug', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <label for="title" class="control-label"><?php echo e('Title'); ?></label>
    <input class="form-control" type="text" name="title" id="title" value="<?php echo e(isset($adminpage->title) ? $adminpage->title : ''); ?>" required> </input>

    <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('content') ? 'has-error' : ''); ?>">
    <label for="content" class="control-label"><?php echo e('Content'); ?></label>
    <textarea class="form-control" name="content" id="content" cols="30" rows="10">
        <?php echo e(isset($adminpage->content) ? $adminpage->content : ''); ?>

    </textarea>
    <?php echo $errors->first('content', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('main_image') ? 'has-error' : ''); ?>">
    <label for="main_image" class="control-label"><?php echo e('Main Image'); ?></label>
    <input class="form-control" type="text" name="main_image" id="main_image" value="<?php echo e(isset($adminpage->main_image) ? $adminpage->main_image : ''); ?>" required> </input>

    <?php echo $errors->first('main_image', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('main_video') ? 'has-error' : ''); ?>">
    <label for="main_video" class="control-label"><?php echo e('Main Video'); ?></label>
    <input class="form-control" type="text" name="main_video" id="main_video" value="<?php echo e(isset($adminpage->main_video) ? $adminpage->main_video : ''); ?>" required> </input>

    <?php echo $errors->first('main_video', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('seo') ? 'has-error' : ''); ?>">
    <label for="seo" class="control-label"><?php echo e('Seo'); ?></label>
    <input class="form-control" type="text" name="seo" id="seo" value="<?php echo e(isset($adminpage->seo) ? $adminpage->seo : ''); ?>" required> </input>

    <?php echo $errors->first('seo', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('seo_description') ? 'has-error' : ''); ?>">
    <label for="seo_description" class="control-label"><?php echo e('Seo Description'); ?></label>
    <textarea class="form-control" name="seo_description" id="seo_description"  cols="30" rows="10">
        <?php echo e(isset($adminpage->seo_description) ? $adminpage->seo_description : ''); ?>

    </textarea>
    <?php echo $errors->first('seo_description', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('sort_order') ? 'has-error' : ''); ?>">
    <label for="sort_order" class="control-label"><?php echo e('Sort Order'); ?></label>
    <input class="form-control" type="number" name="sort_order" id="sort_order" value="<?php echo e(isset($adminpage->sort_order) ? $adminpage->sort_order : ''); ?>" required> </input>

    <?php echo $errors->first('sort_order', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
    <label for="status" class="control-label"><?php echo e('Status'); ?></label>
    <select name="status" class="form-control js-dropdown-select2" id="status" required>
    <?php $__currentLoopData = json_decode('{"1":"Active","0":"Inactive"}', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($optionKey); ?>" <?php echo e((isset($adminpage->status) && $adminpage->status == $optionKey) ? 'selected' : ''); ?>><?php echo e($optionValue); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
    <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

</div>

<?php /**PATH /var/www/html/speedyorder/Modules/AdminPage/Resources/views/form.blade.php ENDPATH**/ ?>