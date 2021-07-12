<?php $__env->startSection('ext_css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="col-md-12">
        <div class="row">

            <div class="col-md-4">
                <div class="hpanel">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">

                                <thead>
                                    <tr>
                                        <th>Order Details</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>
                                        <span class="text-success font-bold">Company Name</span>
                                    </td>
                                    <td><?php echo e(Option::get('company_name')); ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-success font-bold">Order Received</span>
                                    </td>
                                    <td><?php echo e($order->created_at->format('Y-m-d')); ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-success font-bold">Payment Method</span>
                                    </td>
                                    <td><?php echo e($order->payment_method); ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="text-success font-bold">Comment</span>
                                    </td>
                                    <td><?php echo e($order->comment); ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

                <div class="col-md-4">
                    <div class="hpanel">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Customer Details</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="text-success font-bold">Full Name</span>
                                        </td>
                                        <td><?php echo e($order->first_name.' '.$order->last_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-success font-bold">Address</span>
                                        </td>
                                        <td><?php echo e($order->address_1); ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-success font-bold">Email</span>
                                        </td>
                                        <td><?php echo e($order->email); ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-success font-bold">Phone</span>
                                        </td>
                                        <td><?php echo e($order->phone); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>


                    <div class="col-md-4">
                        <div class="hpanel">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Options</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <span class="text-success font-bold">Invoice</span>
                                            </td>
                                            <td class="text-right">
                                                <a href="<?php echo e(route('admin.orders.invoices.show', $order->id  )); ?>" target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="text-success font-bold">Shipping Details</span>
                                            </td>
                                            <td class="text-right">
                                                <a href="<?php echo e(route('admin.orders.shipping.invoices.show', $order->id  )); ?>" target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="col-md-12">

                               <div class="hpanel">
                                <div class="panel-body">
                                    <div class="table-responsive">
                               <table class="table table-bordered">
                                  <thead>
                                     <tr>
                                        <td colspan="2">Order Details</td>
                                     </tr>
                                  </thead>
                                  <tbody>
                                     <tr>
                                        <td style="width: 50%;">
                                           <address>
                                              <strong><?php echo e(Option::get('company_name')); ?></strong><br />
                                              <?php echo e(Option::get('company_address')); ?> <br />
                                           </address>
                                           <b>Telephone</b> <?php echo e(Option::get('company_phone')); ?><br />
                                           <b>E-Mail</b> <?php echo e(Option::get('company_phone')); ?></a><br />
                                           <b>Web Site:</b> <a href="<?php echo e(Option::get('company_site')); ?>"><?php echo e(Option::get('company_site')); ?></a>
                                        </td>
                                        <td style="width: 50%;"><b>Date Added</b> <?php echo e($order->created_at); ?><br />
                                           <b>Order ID:</b> <?php echo e($order->invoice_prefix.$order->invoice_number); ?><br />
                                           <b>Payment Method</b> <?php echo e($order->payment_method); ?><br />
                                           <b>Shipping Method</b> <?php echo e($order->shipping_method); ?><br />
                                        </td>
                                     </tr>
                                  </tbody>
                               </table>

                                    </div>
                                </div>
                               </div>

                               <div class="hpanel">
                                <div class="panel-body">
                                    <div class="table-responsive">
                               <table class="table table-bordered">
                                  <thead>
                                     <tr>
                                        <td style="width: 50%;"><b>Payment Address</b></td>
                                        <td style="width: 50%;"><b>Shipping Address</b></td>
                                     </tr>
                                  </thead>
                                  <tbody>
                                     <tr>
                                        <td>
                                           <address>
                                              <?php echo e($order->payment_address_1); ?><br /><?php echo e($order->payment_address_2); ?><br /><?php echo e($order->payment_city); ?><br /> <?php echo e($order->payment_state); ?> <br/> <?php echo e($order->payment_postcode); ?> <br/> <?php echo e((isset($order->paymentCountry->name)) ? $order->paymentCountry->name : ''); ?> <br/>
                                           </address>
                                        </td>
                                        <td>
                                           <address>
                                              <?php echo e($order->shipping_first_name.' '.$order->shipping_last_name); ?><br /><?php echo e($order->shipping_company); ?><br /><?php echo e($order->shipping_address_1); ?> <br/> <?php echo e($order->shipping_address_2); ?> <br/> <?php echo e($order->shipping_postcode); ?> <br /> <?php echo e($order->shipping_state); ?> <br/>  <br /><?php echo e((isset($order->shippingCountry->name)) ? $order->shippingCountry->name : ''); ?>

                                           </address>
                                        </td>
                                     </tr>
                                  </tbody>
                               </table>
                                    </div>
                                </div>
                               </div>


                               <div class="hpanel">
                                <div class="panel-body">
                                    <div class="table-responsive">
                               <table class="table table-bordered">
                                  <thead>
                                     <tr>
                                        <td><b>Product</b></td>
                                        <td><b>SKU</b></td>
                                        <td class="text-right"><b>Quantity</b></td>
                                        <td class="text-right"><b>Unit Price</b></td>
                                        <td class="text-right"><b>Total</b></td>
                                     </tr>
                                  </thead>
                                  <tbody>
                                       <?php
                                         $subTotal = 0;
                                         $totalTax=0;
                                         $totalShipping=0;
                                         ?>

                                      <?php $__empty_1 = true; $__currentLoopData = $order->orderedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                      <?php

                                           $individualTotal = $orderedProduct->quantity*$orderedProduct->price;
                                           $subTotal += $individualTotal;
                                           $totalTax += $orderedProduct->tax;
                                           $totalShipping += $orderedProduct->shipping_price;

                                       ?>
                                     <tr>
                                        <td>
                                           <?php echo e($orderedProduct->product->name); ?>


                                           <?php if(count($orderedProduct->orderProductOptions)>0): ?>
                                            <p><b>Variant</b></p>
                                           <?php $__currentLoopData = $orderedProduct->orderProductOptions ??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderProductOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <p>[<?php echo e($orderProductOption->productOption->option->name); ?> : <?php echo e(($orderProductOption->productOption->option->type == "select")?$orderProductOption->productOptionValue->optionValue->name:$orderProductOption->value); ?> ]</p>


                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                           <?php endif; ?>
                                        </td>
                                        <td> <?php echo e($orderedProduct->product->sku); ?></td>
                                        <td class="text-right"><?php echo e($orderedProduct->quantity); ?></td>
                                        <td class="text-right"><?php echo e($orderedProduct->price); ?></td>
                                        <td class="text-right"><?php echo e($individualTotal); ?></td>
                                     </tr>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                     <tr>
                                         No data found
                                     </tr>
                                     <?php endif; ?>
                                     <tr>
                                        <td class="text-right" colspan="4"><b>Sub Total</b></td>
                                        <td class="text-right"><?php echo e($subTotal); ?></td>
                                     </tr>
                                     <tr>
                                        <td class="text-right" colspan="4"><b>Tax</b></td>
                                        <td class="text-right"><?php echo e($totalTax); ?></td>
                                     </tr>
                                     <tr>
                                        <td class="text-right" colspan="4"><b>Shipping</b></td>
                                        <td class="text-right"><?php echo e($totalShipping); ?></td>
                                     </tr>
                                     <tr>
                                        <td class="text-right" colspan="4"><b>Total</b></td>
                                        <td class="text-right"><?php echo e(($subTotal+$totalTax+$totalShipping)); ?></td>
                                     </tr>
                                  </tbody>
                               </table>

                                    </div>
                                </div>
                               </div>

                               <div class="col-md-6 mb-5 ">

                                <h2>Order History</h2>

                                <div class="row">
                                    <form action="<?php echo e(route('admin.orders.histories.store')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Order Status</label>
                                            <select name="status" id="status" class="form-control js-dropdown-select2">
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

                                    <div class="form-group col-md-6">
                                        <label class="control-label">Comment</label>
                                        <textarea name="comment" class="form-control" id="" cols="30" rows="3"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                                    <div class="col-md-12 mb-5">
                                        <table class="table table-bordered">
                                            <thead>
                                               <tr>
                                                  <td><b>Date Added</b></td>
                                                  <td><b>Comment</b></td>
                                                  <td><b>Status</b></td>
                                               </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $order->orderHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oHistory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                               <tr>
                                                   <td>
                                                       <?php echo e($oHistory->created_at->format('Y-m-d')); ?>

                                                   </td>
                                                  <td>
                                                    <?php echo e($oHistory->comment); ?>

                                                  </td>
                                                  <td>
                                                    <?php echo e($oHistory->status); ?>

                                                  </td>
                                               </tr>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                               <tr>
                                                    No data found
                                                </tr>
                                               <?php endif; ?>
                                            </tbody>
                                         </table>
                                    </div>

                                </div>

                            </div>
                    </div>
                </div>
            </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('ext_js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorder/Modules/AdminOrder/Resources/views/show.blade.php ENDPATH**/ ?>