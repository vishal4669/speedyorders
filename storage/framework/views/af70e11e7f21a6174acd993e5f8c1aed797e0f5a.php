<?php echo $__env->make('adminorder::formelements.add-product-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<a href="javascript:void(0);" id="openProductModal"
            class="btn btn-primary">
            <i class="fa fa-plus"></i>
        </a>
        <input type="hidden" name="deletedProductId" id="deletedProductId" value="">

        <?php if(old('product_id') || ( isset($order) && $order->products->count() > 0)): ?>
            <?php $display = false ?>
        <?php else: ?>
            <?php $display = true ?>
        <?php endif; ?>

        <div id="product_table" class="form-group <?php echo e(($display) ? 'hidden':''); ?>">
            <h4>Products</h4>
            <table id="option-values-table"
                class="footable table table-stripped table-bordered toggle-arrow-tiny default breakpoint footable-loaded"
                data-page-size="8" data-filter="#filter">
                <thead>
                    <tr>
                        <th class="footable-visible"><span>Name</span></th>
                        <th class="footable-visible footable-sortable"><span>Quantity</span></th>
                        <th class="footable-visible"><span>Variant Value</span></th>
                        <th class="footable-sortable"><span>Action</span></th>
                    </tr>
                </thead>
                <tbody>
          
                    <?php if(old('product_id')!=null): ?>
                    <?php $__currentLoopData = old('product_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $productId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php
                               $oldRow ='';
                           ?> 
                            
                            <?php if(isset(old('option')[$key])): ?>{
                                <?php $__currentLoopData = old('option')[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionType=>$options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionId => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $productOption = App\Models\ProductOption::where('id', $optionId)->with('option')->first();
                                            $productOptionValue = App\Models\ProductOptionValue::where('id', $optionValue)->first();
                                            if(isset($productOptionValue->option)){
                                                if(isset($productOption->option)){
                                                 $oldRow .= 'option['.$productId.']['.$productOption->option->type.']['.$optionId.']['.$optionValue.']' ;
                                                }
                                            }
                                                
                                            ?>
                                            
                                          
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                           
                        <tr style='display: table-row;' class='footable-even' id='<?php echo e($oldRow); ?>'>

                            <td class='footable-visible footable-first-column'>
                                 <input type='hidden' name='product_id[]' value="<?php echo e($productId); ?>">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($productId == $product->id ): ?>
                                        <?php echo e($product->name.'('.$product->sku.')'); ?>

                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            </td>

                            <td class='footable-visible'>
                                <input type='text' name='product_quantity[]' value="<?php echo e(old('product_quantity')[$key]); ?>">
                            </td>

                            <td>
                                <?php if(old('option') && isset(old('option')[$key])): ?>
                                    <?php $__currentLoopData = old('option')[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionType=>$options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       
                                            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionId => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $productOption = App\Models\ProductOption::where('id', $optionId)->with('option')->first();
                                                    $value = App\Models\ProductOptionValue::where('id', $optionValue)->first();
                                                    if($value){
                                                        $productOptionValue  = $value;
                                                    }
                                                    else{
                                                        $productOptionValue = $optionValue;
                                                    }
                                               ?>
                                                <p><?php echo e((isset($productOption->option) && $productOption->option->name)); ?> : <?php echo e($productOptionValue->optionValue->name ?? $productOptionValue); ?> </p>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                                                             
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>

                            <td class='footable-visible footable-last-column'>
                                <button type='button' class='btn btn-danger dlt-product'><i class='fa fa-trash'></i></button>
                            </td>
                            
                          
                            <td class="hidden">
                                <?php if(old('option') && isset(old('option')[$key])): ?>
                                    <?php $__currentLoopData = old('option')[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionType=>$options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       
                                            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionId => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="text" data-id="[<?php echo e($optionType); ?>][<?php echo e($optionId); ?>]" class="hiddenInput"  name="option[<?php echo e($key); ?>][<?php echo e($optionType); ?>][<?php echo e($optionId); ?>]" value="<?php echo e($optionValue); ?>">
                                                      
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                                                            
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>

                     </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <?php $__currentLoopData = $order->orderedProducts ??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$orderProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php
                           $rowId = '';
                         
                           if(count($orderProduct->orderProductOptions)>0){
                               foreach($orderProduct->orderProductOptions ??[] as $orderProductOption)
                                {
                                    $value = "";
                                    if(isset($orderProductOption->productOption) && !empty($orderProductOption->productOption) && isset($orderProductOption->productOption->option)){

                                        if(isset($orderProductOption->productOption->id)){
                                            $value =($orderProductOption->productOption->option->type == "select" && isset($orderProductOption->productOptionValue->id))?$orderProductOption->productOptionValue->id:$orderProductOption->value;

                                        
                                            $rowId.='option['.$orderProduct->product_id.']['.$orderProductOption->productOption->option->type.']['.$orderProductOption->productOption->id.']['.$value.']' ;
                                        }
                                    }
                                }
                        }
                        else{
                            $rowId = $orderProduct->product_id;
                        }
                    ?>                     
                    <tr style='display: table-row;' class='footable-even' id="<?php echo e($rowId); ?>">
                        <td class='footable-visible footable-first-column'>
                            <input type="hidden" name="product_id[]" value="<?php echo e($orderProduct->product_id); ?>">
                            <?php echo e($orderProduct->product->name); ?>

                        </td>
                        <td class='footable-visible'>
                            <input type="text" name="product_quantity[]" value="<?php echo e($orderProduct->quantity); ?>">
                        </td>
                        <td>
                           <?php if(isset($orderProduct->orderProductOptions) && !empty($orderProduct->orderProductOptions)): ?>
                                <?php $__currentLoopData = $orderProduct->orderProductOptions ??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderProductOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if(isset($orderProductOption->productOption) && !empty($orderProductOption->productOption)): ?>
                                        <p><?php echo e($orderProductOption->productOption->option->name); ?> :<?php echo e(($orderProductOption->productOption->option->type == "select" && isset($orderProductOption->productOptionValue->optionValue->name))?$orderProductOption->productOptionValue->optionValue->name:$orderProductOption->value); ?>  </p>
                                    <?php endif; ?>    
                               
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php endif; ?>  
                        </td>
                        <td class='footable-visible footable-last-column'>
                            <button type='button' class='btn btn-danger dlt-product'><i class='fa fa-trash'></i></button>
                        </td>
                        <td class="hidden">
                            <?php $__currentLoopData = $orderProduct->orderProductOptions ??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderProductOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($orderProductOption->productOption) && !empty($orderProductOption->productOption) && isset($orderProductOption->productOption->id)): ?>
                                    <input type="text" data-id="[<?php echo e($orderProductOption->productOption->option->type); ?>][<?php echo e($orderProductOption->productOption->id); ?>]" class="hiddenInput"  name="option[<?php echo e($key); ?>][<?php echo e($orderProductOption->productOption->option->type); ?>][<?php echo e($orderProductOption->productOption->id); ?>]" value="<?php echo e(($orderProductOption->productOption->option->type == "select" && isset($orderProductOption->productOptionValue->id)) ? $orderProductOption->productOptionValue->id:$orderProductOption->value); ?>">
                                <?php endif; ?>    
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div><?php /**PATH /home/speedyorders/public_html/modban.com/Modules/AdminOrder/Resources/views/formelements/product.blade.php ENDPATH**/ ?>