<div class="hpanel">
    <input type="text" class="hidden" name="option_id[<?php echo e($counter); ?>]" value="<?php echo e($option->id); ?>">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-3">
                <h5><strong><?php echo e($option->name); ?></strong> </h5>
            </div>
            <div class="col-md-4 pull-right text-right">
                <a  class="btn btn-danger delete-hpanel"><i class="pe-7s-close-circle"></i></a>
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
                <tr style="display: table-row;" class="footable-even">
                    <td class="footable-visible">
                        <select name="option[select][option_values][<?php echo e($counter); ?>][]" class="form-control">
                            <?php $__currentLoopData = $option->optionValues ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td class="footable-visible">
                        <input type="number" class="form-control" name="option[select][quantity][<?php echo e($counter); ?>][]" placeholder="Total Option Stock"
                            required>
                    </td>
                    <td class="footable-visible">
                        <select name="option[select][subtract_from_stock][<?php echo e($counter); ?>][]" class="form-control" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                    <td class="footable-visible">

                        <select name="option[select][price_prefix][<?php echo e($counter); ?>][]" class="form-control" required>
                            <option value="+">+</option>
                            <option value="-">-</option>
                        </select>

                    </td>
                    <td class="footable-visible">
                        <input type="number" class="form-control" name="option[select][price][<?php echo e($counter); ?>][]" placeholder="Price"
                            required>
                    </td>
                    <td class="footable-visible footable-last-column"><a
                            class="btn btn-danger remove-option-value"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr style="display: table-row;" class="footable-even">
                    <td class="footable-visible" colspan="5"></td>
                    <td class="footable-visible footable-last-column"><a
                            class="btn btn-primary add-option-value" data-option-id="<?php echo e($option->id); ?>"><i class="fa fa-plus"></i></a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php /**PATH /var/www/html/speedyorder/Modules/AdminProduct/Resources/views/htmlelement/select.blade.php ENDPATH**/ ?>