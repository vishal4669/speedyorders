
            <div class="hr-line-dashed"></div>
            <label>PACKAGE TYPE</label>

            <div class="form-group">
                <label class="col-md-2 control-label">Package Type</label>
                <div class="col-md-4">
                    <select required class="form-control m-b js-dropdown-select2" name="package_type">
                        <option value="1" <?php if(old('type', isset($package) ? $package->package_type : null) == '1'): ?> selected <?php endif; ?>>Box</option>
                        <option value="2" <?php if(old('type', isset($package) ? $package->package_type : null) == '2'): ?> selected <?php endif; ?>>Soft Package / satchel</option>
                    </select>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <label>SIZE & WEIGHT</label>

            <div class="form-group">
                <label class="col-md-1 control-label">Length</label>
                <div class="col-md-1">
                    <input type="number" min="0" name="package_length" value="<?php echo e(old('amount', isset($package) ? $package->package_length : null)); ?>" class="form-control">
                </div>
            
                <label class="col-md-1 control-label">Width</label>
                <div class="col-md-1">
                    <input type="number" min="0" name="package_width" value="<?php echo e(old('amount', isset($package) ? $package->package_width : null)); ?>" class="form-control">
                </div>

                <label class="col-md-1 control-label">Height</label>
                <div class="col-md-1">
                    <input type="number" min="0" name="package_height" value="<?php echo e(old('amount', isset($package) ? $package->package_height : null)); ?>" class="form-control">
                </div>

                <div class="col-md-1">
                   <select class="form-control m-b js-dropdown-select2" name="package_size_unit" required>
                        <option value="cm" <?php if(old('type', isset($package) ? $package->package_size_unit : null) == 'cm'): ?> selected <?php endif; ?>>CM</option>
                        <option value="inch" <?php if(old('type', isset($package) ? $package->package_size_unit : null) == 'inch'): ?> selected <?php endif; ?>>INCH</option>
                    </select>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            
            <div class="form-group">
                <label class="col-md-2 control-label">Weight When empty (optional)</label>
                <div class="col-md-4">
                    <input type="text" name="package_weight" value="<?php echo e(old('limit_per_user', isset($package) ? $package->package_weight : null)); ?>"
                        class="form-control">
                </div>

                <div class="col-md-2">
                   <select class="form-control m-b js-dropdown-select2" name="package_weight_unit">
                        <option value="1" <?php if(old('type', isset($package) ? $package->package_weight_unit : null) == 'kg'): ?> selected <?php endif; ?>>KG</option>
                        <option value="2" <?php if(old('type', isset($package) ? $package->package_weight_unit : null) == 'lb'): ?> selected <?php endif; ?>>LB</option>
                    </select>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <label>NAME</label>

            <div class="form-group">
                <label class="col-md-2 control-label">Package Name</label>
                <div class="col-md-4">
                    <input type="text" required name="package_name" value="<?php echo e(old('package_name', isset($package) ? $package->package_name : null)); ?>"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Set as default Package</label>
                <div class="col-md-4">
                    <select class="form-control m-b js-dropdown-select2" name="is_default">
                        <option value="1" <?php if(old('is_default', isset($package) ? $package->is_default : null) == 1): ?> selected <?php endif; ?>>Yes</option>
                        <option value="0" <?php if(old('is_default', isset($package) ? $package->is_default : null) == 0): ?> selected <?php endif; ?>>No</option>
                    </select>
                </div>
            </div>

<?php $__env->startSection('ext_js'); ?>
    <script type="text/javascript">
    $(document).ready(function(){
        
        $("#createPackageForm").validate({
             rules: {
               package_length: "required",
               package_height: "required",
               package_width: "required",
               package_name: "required",
             },
             messages : {
                package_length : {required : 'Required'},
                package_height : {required : 'Required'},
                package_width : {required : 'Required'},
                package_name : {required : 'Required'}
             },
             highlight: function (element, errorClass, validClass) {
               var elem = $(element);
               if (elem.hasClass("select2-hidden-accessible")) {
                   $("#select2-" + elem.attr("id") + "-container").parent().addClass(errorClass); 
               } else {
                   elem.addClass(errorClass);
               }
             },    
             unhighlight: function (element, errorClass, validClass) {
                 var elem = $(element);
                 if (elem.hasClass("select2-hidden-accessible")) {
                      $("#select2-" + elem.attr("id") + "-container").parent().removeClass(errorClass);
                 } else {
                     elem.removeClass(errorClass);
                 }
             },
             errorPlacement: function(error, element) {
               var elem = $(element);
               if (elem.hasClass("select2-hidden-accessible")) {
                   element = $("#select2-" + elem.attr("id") + "-container").parent(); 
                   error.insertAfter(element);
               } else {
                   error.insertAfter(element);
               }
             }
           });

        $("#updatePackageForm").validate({
             rules: {
               package_length: "required",
               package_height: "required",
               package_width: "required",
               package_name: "required",
             },
             messages : {
                package_length : {required : 'Required'},
                package_height : {required : 'Required'},
                package_width : {required : 'Required'},
                package_name : {required : 'Required'}
             },
             highlight: function (element, errorClass, validClass) {
               var elem = $(element);
               if (elem.hasClass("select2-hidden-accessible")) {
                   $("#select2-" + elem.attr("id") + "-container").parent().addClass(errorClass); 
               } else {
                   elem.addClass(errorClass);
               }
             },    
             unhighlight: function (element, errorClass, validClass) {
                 var elem = $(element);
                 if (elem.hasClass("select2-hidden-accessible")) {
                      $("#select2-" + elem.attr("id") + "-container").parent().removeClass(errorClass);
                 } else {
                     elem.removeClass(errorClass);
                 }
             },
             errorPlacement: function(error, element) {
               var elem = $(element);
               if (elem.hasClass("select2-hidden-accessible")) {
                   element = $("#select2-" + elem.attr("id") + "-container").parent(); 
                   error.insertAfter(element);
               } else {
                   error.insertAfter(element);
               }
             }
           });


    });
</script>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/speedyorders/Modules/AdminShipping/Resources/views/shippingpackage/form.blade.php ENDPATH**/ ?>