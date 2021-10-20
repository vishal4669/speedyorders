            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"><strong>General Info</strong></a>
                </li>
                <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Address</a></li>
                <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">Transaction</a></li>
                <?php if(isset($customer)): ?>
                    <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">Ip</a></li>
                <?php endif; ?>
            </ul>
            <br>

            <div class="tab-content">

            <div id="tab-1" class="tab-pane active">

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">First Name<span class="error">*</span></label>
                <div class="col-md-4">
                    <input type="text" name="first_name" required value="<?php echo e(old('first_name', isset($customer) ? $customer->first_name : null)); ?>"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Last Name<span class="error">*</span></label>
                <div class="col-md-4">
                    <input type="text" name="last_name" required value="<?php echo e(old('last_name', isset($customer) ? $customer->last_name : null)); ?>"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Email<span class="error">*</span></label>
                <div class="col-md-4">
                    <input type="email" name="email" required value="<?php echo e(old('email', isset($customer) ? $customer->email : null)); ?>"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Phone<span class="error">*</span></label>
                <div class="col-md-4">
                    <input type="text" name="telephone" required value="<?php echo e(old('telephone', isset($customer) ? $customer->telephone : null)); ?>"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">NewsLetter</label>
                <div class="col-md-4">
                    <select class="form-control m-b js-dropdown-select2" name="newsletter">
                        <option value="0" <?php if(old('newsletter', isset($customer) ? $customer->newsletter : null) == '0'): ?> selected <?php endif; ?>>Disabled</option>
                        <option value="1" <?php if(old('newsletter', isset($customer) ? $customer->newsletter : null) == '1'): ?> selected <?php endif; ?>>Enabled</option>
                    </select>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Safe</label>
                <div class="col-md-4">
                    <select class="form-control m-b js-dropdown-select2" name="safe">
                        <option value="1" <?php if(old('safe', isset($customer) ? $customer->safe : null) == '1'): ?> selected <?php endif; ?>>Yes</option>
                        <option value="0" <?php if(old('safe', isset($customer) ? $customer->safe : null) == '0'): ?> selected <?php endif; ?>>No</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Publish Status</label>
                <div class="col-md-4">
                    <select class="form-control m-b js-dropdown-select2" name="status">
                        <option value="1" <?php if(old('status', isset($customer) ? $customer->status : null) == 1): ?> selected <?php endif; ?>>Yes</option>
                        <option value="0" <?php if(old('status', isset($customer) ? $customer->status : null) == 0): ?> selected <?php endif; ?>>No</option>
                    </select>
                </div>
            </div>

        </div>

        <div id="tab-2" class="tab-pane">

            <input type="hidden" name="address_id" value="<?php echo e(old('address_id')); ?>" id="address_id">

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">First Name</label>
                <div class="col-md-4">
                    <input type="text" name="a_first_name" value="<?php echo e(old('a_first_name')); ?>"
                        class="form-control" id="a_first_name">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Last Name</label>
                <div class="col-md-4">
                    <input type="text" name="a_last_name" value="<?php echo e(old('a_last_name')); ?>"
                        class="form-control" id="a_last_name">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Address 1</label>
                <div class="col-md-4">
                    <input type="text" name="address_1" value="<?php echo e(old('address_1')); ?>"
                        class="form-control" id="address_1">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Address 2</label>
                <div class="col-md-4">
                    <input type="text" name="address_2" value="<?php echo e(old('address_2')); ?>"
                        class="form-control" id="address_2">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">City Name</label>
                <div class="col-md-4">
                    <input type="text" name="city" value="<?php echo e(old('city')); ?>"
                        class="form-control" id="city">
                </div>
            </div>


            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Postcode</label>
                <div class="col-md-4">
                    <input type="text" name="postcode" value="<?php echo e(old('postcode')); ?>"
                        class="form-control" id="postcode">
                </div>
            </div>

            <!-- <div class="hr-line-dashed"></div> -->

           <!--  <div class="form-group">
                <label class="col-md-2 control-label">Country</label>
                <div class="col-md-4">
                    <input type="text" name="country" value="<?php echo e(old('country')); ?>"
                        class="form-control" id="country">
                </div>
            </div>

            <div class="hr-line-dashed"></div> -->

           <!--  <div class="form-group">
                <label class="col-md-2 control-label">Region Id</label>
                <div class="col-md-4">
                    <input type="text" name="region_id" value="<?php echo e(old('region_id')); ?>"
                        class="form-control" id="region_id">
                </div>
            </div> -->

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <div class="col-md-4">
                        <a href="void();" class="btn btn-primary pull-right" id="resetEditAddress" style="display: none;">Reset Editing</a>
                </div>
            </div>

            <?php if(isset($customer)): ?>
            <div class="form-group">
                <h4>Addresses</h4>
                <table id="option-values-table"
                    class="footable table table-stripped table-bordered toggle-arrow-tiny default breakpoint footable-loaded"
                    data-page-size="8" data-filter="#filter">
                    <thead>
                        <tr>
                            <th class="footable-visible">Name</span></th>
                            <th class="footable-visible footable-sortable">Address 1</span></th>
                            <th class="footable-visible footable-sortable">Address 2</span></th>
                            <th class="footable-visible footable-sortable">Postal Code</span></th>
                            <th class="footable-sortable">Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($customer->addresses)): ?>
                            <?php $__currentLoopData = $customer->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style='display: table-row;' class='footable-even' id="address_<?php echo e($item->id); ?>">
                                <td class='footable-visible footable-first-column'>
                                    <?php echo e($item->a_first_name.' '.$item->a_last_name); ?>

                                </td>
                                <td class='footable-visible'>
                                    <?php echo e($item->address_1); ?>

                                </td>
                                <td class='footable-visible'>
                                    <?php echo e($item->address_2); ?>

                                </td>

                                <td class='footable-visible'>
                                    <?php echo e($item->postcode); ?>

                                </td>

                                <td class='footable-visible footable-last-column'>
                                    <button type='button' data-address-id='<?php echo e($item->id); ?>' data-delete-url="<?php echo e(route('admin.customers.address.delete',$item->id)); ?>" class='btn btn-danger delete-address-btn'><i class='fa fa-trash'></i></button>
                                    <button type='button' class='btn btn-danger edit-address-btn' data-edit-url="<?php echo e(route('admin.customers.address.details',$item->id)); ?>"><i class="fa fa-edit"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            No data found
                        <?php endif; ?>
                    </tbody>
                  <!--   <tfoot>
                        <tr style="display: table-row;" class="footable-even">
                            <td class="footable-visible footable-first-column"></td>
                            <td class="footable-visible"></td>
                            <td class="footable-visible"></td>
                            <td class="footable-visible footable-last-column"></td>
                        </tr>
                    </tfoot> -->
                </table>
            </div>

            <?php endif; ?>

        </div>

        <div id="tab-3" class="tab-pane">

            <input type="hidden" name="transaction_id" value="<?php echo e(old('transaction_id')); ?>" id="transaction_id">

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Description</label>
                <div class="col-md-4">
                    <input type="text" name="description" value="<?php echo e(old('description')); ?>" class="form-control" id="description">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Amount</label>
                <div class="col-md-4">
                    <input type="text" name="amount" value="<?php echo e(old('amount')); ?>" class="form-control" id="amount">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    <a href="void();" class="btn btn-primary pull-right" id="resetEditTransaction" style="display: none;">Reset Editing</a>
                </div>
            </div>

            <?php if(isset($customer->transactions)): ?>
            <div class="form-group">
                <h4>Transactions</h4>
                <table id="option-values-table"
                    class="footable table table-stripped table-bordered toggle-arrow-tiny default breakpoint footable-loaded"
                    data-page-size="8" data-filter="#filter">
                    <thead>
                        <tr>
                            <th class="footable-visible">Description</span></th>
                            <th class="footable-visible footable-sortable">Amount</span></th>
                            <th class="footable-sortable">Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $customer->transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr id style='display: table-row;' class='footable-even'>
                            <td class='footable-visible footable-first-column'>
                                <?php echo e($item->description); ?>

                            </td>
                            <td class='footable-visible'>
                                <?php echo e($item->amount); ?>

                            </td>
                            <td class='footable-visible footable-last-column'>
                                <button type='button' class='btn btn-danger delete-option-value'><i class='fa fa-trash'></i></button>
                                <button type='button' class='btn btn-danger edit-transaction-btn' data-edit-url="<?php echo e(route('admin.customers.transaction.details',$item->id)); ?>"><i class='fa fa-eye'></i></button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr style="display: table-row;" class="footable-even">
                            <td class="footable-visible footable-first-column"></td>
                            <td class="footable-visible"></td>
                            <td class="footable-visible footable-last-column">

                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <?php endif; ?>

        </div>

        <?php if(isset($customer)): ?>
        <div id="tab-4" class="tab-pane">
            <input type="hidden" name="ip_id" value="" id="ip_id">

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Ips</label>
                <div class="col-md-4">
                    <input type="text" name="ip" value="<?php echo e(old('ip')); ?>" class="form-control" id="ip">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Total Accounts</label>
                <div class="col-md-4">
                    <input type="text" name="total_accounts" value="<?php echo e(old('total_accounts')); ?>" class="form-control" id="total_accounts">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                        <a href="void();" class="btn btn-primary pull-right" id="resetEditIp" style="display: none;">Reset Editing</a>
                </div>
            </div>

            <?php if(isset($customer->ips)): ?>
            <div class="form-group">
                <h4>Ips</h4>
                <table id="option-values-table"
                    class="footable table table-stripped table-bordered toggle-arrow-tiny default breakpoint footable-loaded"
                    data-page-size="8" data-filter="#filter">
                    <thead>
                        <tr>
                            <th class="footable-visible">Ip</span></th>
                            <th class="footable-visible footable-sortable">Total Accounts</span></th>
                            <th class="footable-sortable">Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $customer->ips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id style='display: table-row;' class='footable-even'>
                            <td class='footable-visible footable-first-column'>
                                <?php echo e($item->ip); ?>

                            </td>
                            <td class='footable-visible'>
                                <?php echo e($item->total_accounts); ?>

                            </td>
                            <td class='footable-visible footable-last-column'>
                                <button type='button' class='btn btn-danger delete-option-value'><i class='fa fa-trash'></i></button>
                                <button type='button' class='btn btn-danger edit-ip-btn'  data-edit-url="<?php echo e(route('admin.customers.ipaddress.details',$item->id)); ?>"><i class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr style="display: table-row;" class="footable-even">
                            <td class="footable-visible footable-first-column"></td>
                            <td class="footable-visible"></td>
                            <td class="footable-visible footable-last-column">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
<?php /**PATH /home/speedyorders/public_html/modban.com/Modules/AdminCustomer/Resources/views/form.blade.php ENDPATH**/ ?>