<?php $__env->startSection('ext_css'); ?>
<style>
    .p-2{
        padding: 2px;
    }

    .mb-5{
        margin-bottom: 5px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="hpanel">
    <div class="panel-body">
        <h4>Order</h4>
        <form method="GET" action="<?php echo e(route('admin.reports.customerorder.index')); ?>" id="filterOrder">

        <div class="row">
                <?php echo csrf_field(); ?>
                <div class="col-md-2 p-2">
                    <input type="date" class="form-control" name="startDate" placeholder="Start Date">
                    <span class="input-group-btn">
                    </span>
                </div>
                <div class="col-md-2 p-2">
                    <input type="date" class="form-control" name="endDate" placeholder="End Date">
                    <span class="input-group-btn">
                    </span>
                </div>
                <div class="col-md-2 p-2">
                    <select class="form-control m-b js-dropdown-select2" name="customer_id">
                        <option value="">All</option>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->email); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2 p-2">
                    <select name="status" id="status" class="form-control js-dropdown-select2">
                        <option value="">Any</option>
                        <option value="6" <?php if(old('status')=='6'): ?> selected <?php endif; ?>>Canceled</option>
                        <option value="7" <?php if(old('status')=='7'): ?> selected <?php endif; ?>>Canceled Reversal</option>
                        <option value="8" <?php if(old('status')=='8'): ?> selected <?php endif; ?>>Chargeback</option>
                        <option value="4" <?php if(old('status')=='4'): ?> selected <?php endif; ?>>Complete</option>
                        <option value="5" <?php if(old('status')=='5'): ?> selected <?php endif; ?>>Delivered</option>
                        <option value="9" <?php if(old('status')=='9'): ?> selected <?php endif; ?>>Denied</option>
                        <option value="10" <?php if(old('status')=='10'): ?> selected <?php endif; ?>>Expired</option>
                        <option value="11" <?php if(old('status')=='11'): ?> selected <?php endif; ?>>Failed</option>
                        <option value="1" <?php if(old('status')=='1'): ?> selected <?php endif; ?>>Pending</option>
                        <option value="3" <?php if(old('status')=='3'): ?> selected <?php endif; ?>>Processed</option>
                        <option value="2" <?php if(old('status')=='2'): ?> selected <?php endif; ?>>Processing</option>
                        <option value="12" <?php if(old('status')=='12'): ?> selected <?php endif; ?>>Refunded</option>
                        <option value="13" <?php if(old('status')=='13'): ?> selected <?php endif; ?>>Reversed</option>
                        <option value="14" <?php if(old('status')=='14'): ?> selected <?php endif; ?>>Shipped</option>
                        <option value="15" <?php if(old('status')=='15'): ?> selected <?php endif; ?>>Voided</option>
                    </select>
                </div>
                <div class="col-md-2 p-2">
                    
                    <input type="text" class="form-control" name="invoice_number" placeholder="Invoice Number">
                    
                </div>
               
                
            
        </div>
       
    </form>   
        
        
        <div class="row">
            <div class="col-md-12  ">
                
                <form method="GET" action="<?php echo e(route('admin.reports.customerorder.export')); ?>" id="hiddenOrderForm">
                    
                    <?php echo csrf_field(); ?>
                    <input type="hidden" class="form-control" name="startDate" value="<?php echo e($data['startDate']??''); ?>" >
                    <input type="hidden" class="form-control" name="endDate" value="<?php echo e($data['endDate']??''); ?>">
                    <input type="hidden" name="customer_id" value="<?php echo e($data['customer_id']??''); ?>">
                    <input type="hidden" name="status" value="<?php echo e($data['status']??''); ?>">
                    <input type="hidden" name="invoice_number" value="<?php echo e($data['invoice_number']??''); ?>">
                    
                </form>
                
                <button class="btn btn-success pull-right" type="submit" form="hiddenOrderForm">Export to xlsx</button>
                
                <button type="submit" class="btn btn-primary  pull-right" form="filterOrder">Filter</button>
                
                
                
            </div>
        </div>
        
    </div>
    
</div>
<div class="table-responsive">
    <table id="productTable" class="table table-bordered table-striped speedy-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Product Sku</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Tax</th>
                <th>Shipping Price</th>
                <th>Order Date</th>
                <th>Invoice No</th>
                <th>Address 1</th>
                <th>Payment Name</th>
                <th>Payment Company</th>
                <th>Payment Addres</th>
                <th>Payment Code</th>
                <th>Shipping Name</th>
                <th>Shipping Company</th>
                <th>Shipping Address</th>
                <th>Shipping City</th>
                <th>Shipping Method</th>
                <th>Latest Comment</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $orderProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($orderProduct->order->first_name.' '.$orderProduct->order->last_name); ?></td>
                <td><?php echo e($orderProduct->order->email); ?></td>
                <td><?php echo e($orderProduct->sku); ?></td>
                <td><?php echo e($orderProduct->quantity); ?></td>
                <td><?php echo e($orderProduct->price); ?></td>
                <td><?php echo e($orderProduct->tax); ?></td>
                <td><?php echo e($orderProduct->shipping_price); ?></td>
                <td><?php echo e($orderProduct->created_at); ?></td>
                <td><?php echo e($orderProduct->order->invoice_number); ?></td>
                <td><?php echo e($orderProduct->order->address1); ?></td>
                <td><?php echo e($orderProduct->order->payment_first_name.' '.$orderProduct->order->payment_last_name); ?></td>
                <td><?php echo e($orderProduct->order->payment_company); ?></td>
                <td><?php echo e($orderProduct->order->payment_address1); ?></td>
                <td><?php echo e($orderProduct->order->payment_unique_code); ?></td>
                <td><?php echo e($orderProduct->order->shipping_first_name.' '.$orderProduct->order->shipping_last_name); ?></td>
                <td><?php echo e($orderProduct->order->shipping_company); ?></td>
                <td><?php echo e($orderProduct->order->shipping_address1); ?></td>
                <td><?php echo e($orderProduct->order->shipping_city); ?></td>
                <td><?php echo e($orderProduct->order->shipping_method); ?></td>
                <td><?php echo e($orderProduct->order->orderHistories[0]->comment?? ' '); ?></td>
                
            </tr>
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tfoot>
                <tr>
                    <td class="text-center" colspan="20">
                        <span>No data available in the table...</span>
                    </td>
                </tr>
            </tfoot>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ext_js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorders/Modules/AdminReport/Resources/views/order-index.blade.php ENDPATH**/ ?>