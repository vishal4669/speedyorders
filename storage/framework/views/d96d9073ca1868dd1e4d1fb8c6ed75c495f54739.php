<div class="row">
            <div class="col-md-6">
                <label for="option">Option Required</label>
                <select name="option_required" class="form-control">
                    <option value="1"
                    <?php if(isset($product->options) && $product->options->first()!=null && $product->options->first()->required ==1): ?> selected <?php endif; ?>>
                    Yes</option>
                    <option value="0"
                    <?php if(isset($product->options) && $product->options->first()!=null && $product->options->first()->required ==0): ?> selected <?php endif; ?>>
                    No</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="option">Options</label>
                
                <select class="form-control " list="options" id="options">
                    <option value="">select options</option>
                    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($option->id); ?>"><?php echo e($option->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="options-panel">
            <?php if($action == 'edit'): ?>
                <?php $__empty_1 = true; $__currentLoopData = $product->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter=>$productOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php switch($productOption->option->type):
                        case ('input'): ?>
                        <div class="hpanel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5><strong><?php echo e($productOption->option->name); ?></strong> </h5>
                                    </div>
                                    <div class="col-md-4 pull-right text-right">
                                        <button class="btn btn-danger delete-hpanel"><i class="pe-7s-close-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="option-values-table"
                                    class="footable table table-bordered toggle-arrow-tiny default breakpoint footable-loaded"
                                    data-page-size="8" data-filter="#filter">
                                    <thead>
                                        <tr>
                                            <th class="footable-visible">Value</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="display: table-row;" class="footable-even">
                                            <td class="footable-visible" colspan="5">
                                                <input type="text" class="form-control"
                                                    name="option[input][<?php echo e($productOption->option->id); ?>]"
                                                    value="<?php echo e($productOption->optionValues->first()->input_value); ?>" required>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php break; ?>
                        <?php case ('select'): ?>
                        <div class="hpanel">
                            <input type="text" class="hidden" name="option_id[<?php echo e($counter); ?>]"
                                value="<?php echo e($option->id); ?>">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5><strong><?php echo e($productOption->option->name); ?></strong> </h5>
                                    </div>
                                    <div class="col-md-4 pull-right text-right">
                                        <a class="btn btn-danger delete-hpanel"><i class="pe-7s-close-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table
                                    class="option-values-table footable table table-bordered toggle-arrow-tiny default breakpoint footable-loaded"
                                    data-page-size="8" data-filter="#filter">
                                    <thead>
                                        <tr>
                                            <th class="footable-visible">Value</span></th>
                                            <th class="footable-visible footable-sortable">Quantity</span></th>
                                            <th class="footable-visible footable-sortable">Subtract stock</span></th>
                                            <th class="footable-visible footable-sortable">prefix</span></th>
                                            <th class="footable-visible footable-sortable">Price</span></th>
                                            <th class="footable-sortable">Operation</span></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody<?php echo e($option->id); ?>">
                                        <?php $__currentLoopData = $productOption->optionValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productOptionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr style="display: table-row;" class="footable-even">
                                                <td class="footable-visible">
                                                    <select name="option[select][option_values][<?php echo e($counter); ?>][]"
                                                        class="form-control">
                                                        <?php $__currentLoopData = $productOption->option->optionValues ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($item->id); ?>"
                                                                <?php echo e($item->id == $productOptionValue->option_value_id ? 'selected' : ''); ?>>
                                                                <?php echo e($item->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td class="footable-visible">
                                                    <input type="number" value="<?php echo e($productOptionValue->quantity); ?>"
                                                        class="form-control"
                                                        name="option[select][quantity][<?php echo e($counter); ?>][]"
                                                        value="<?php echo e('s'); ?>" placeholder="Total Option Stock" required>
                                                </td>
                                                <td class="footable-visible">
                                                    <select name="option[select][subtract_from_stock][<?php echo e($counter); ?>][]"
                                                        class="form-control" required>
                                                        <option value="1" <?php if($productOptionValue->subtract_from_stock == 1): ?> selected <?php endif; ?>>Yes</option>
                                                        <option value="0" <?php if($productOptionValue->subtract_from_stock == 0): ?> selected <?php endif; ?>>No</option>
                                                    </select>
                                                </td>
                                                <td class="footable-visible">
                                                    <select name="option[select][price_prefix][<?php echo e($counter); ?>][]"
                                                        class="form-control" required>
                                                        <option value="1"
                                                            <?php echo e($productOptionValue->price_prefix == '1' ? 'selected' : ''); ?>>+
                                                        </option>
                                                        <option value="0"
                                                            <?php echo e($productOptionValue->price_prefix == '0' ? 'selected' : ''); ?>>-
                                                        </option>
                                                    </select>

                                                </td>
                                                <td class="footable-visible">
                                                    <input type="number" value="<?php echo e($productOptionValue->price); ?>"
                                                        class="form-control"
                                                        name="option[select][price][<?php echo e($counter); ?>][]" placeholder="Price"
                                                        required>
                                                </td>
                                                <td class="footable-visible footable-last-column"><a
                                                        class="remove-option-value btn btn-danger"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>
                                        <tr style="display: table-row;" class="footable-even">
                                            <td class="footable-visible" colspan="5"></td>
                                            <td class="footable-visible footable-last-column"><a
                                                    class="btn btn-primary add-option-value"
                                                    data-option-id="<?php echo e($option->id); ?>"><i class="fa fa-plus"></i></a>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <?php break; ?>
                    <?php endswitch; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php endif; ?>
            <?php endif; ?>
        </div>
<?php /**PATH /var/www/html/speedyorder/Modules/AdminProduct/Resources/views/forms/option.blade.php ENDPATH**/ ?>