            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"><strong>General Info</strong></a>
                </li>
                <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">Address</a></li>
                <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">Transaction</a></li>
                @if(isset($customer))
                    <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">Ip</a></li>
                @endif
            </ul>
            <br>

            <div class="tab-content">

            <div id="tab-1" class="tab-pane active">

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">First Name</label>
                <div class="col-md-4">
                    <input type="text" name="first_name" value="{{ old('first_name', isset($customer) ? $customer->first_name : null) }}"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Last Name</label>
                <div class="col-md-4">
                    <input type="text" name="last_name" value="{{ old('last_name', isset($customer) ? $customer->last_name : null) }}"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Email</label>
                <div class="col-md-4">
                    <input type="text" name="email" value="{{ old('email', isset($customer) ? $customer->email : null) }}"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Phone</label>
                <div class="col-md-4">
                    <input type="text" name="telephone" value="{{ old('telephone', isset($customer) ? $customer->telephone : null) }}"
                        class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">NewsLetter</label>
                <div class="col-md-4">
                    <select class="form-control m-b js-dropdown-select2" name="newsletter">
                        <option value="0" @if (old('newsletter', isset($customer) ? $customer->newsletter : null) == '0') selected @endif>Disabled</option>
                        <option value="1" @if (old('newsletter', isset($customer) ? $customer->newsletter : null) == '1') selected @endif>Enabled</option>
                    </select>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Safe</label>
                <div class="col-md-4">
                    <select class="form-control m-b js-dropdown-select2" name="safe">
                        <option value="1" @if (old('safe', isset($customer) ? $customer->safe : null) == '1') selected @endif>Yes</option>
                        <option value="0" @if (old('safe', isset($customer) ? $customer->safe : null) == '0') selected @endif>No</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Publish Status</label>
                <div class="col-md-4">
                    <select class="form-control m-b js-dropdown-select2" name="status">
                        <option value="1" @if (old('status', isset($customer) ? $customer->status : null) == 1) selected @endif>Yes</option>
                        <option value="0" @if (old('status', isset($customer) ? $customer->status : null) == 0) selected @endif>No</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="tab-2" class="tab-pane">

            <input type="hidden" name="address_id" value="{{ old('address_id') }}" id="address_id">

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">First Name</label>
                <div class="col-md-4">
                    <input type="text" name="c_first_name" value="{{ old('c_first_name') }}"
                        class="form-control" id="c_first_name">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Last Name</label>
                <div class="col-md-4">
                    <input type="text" name="c_last_name" value="{{ old('c_last_name')}}"
                        class="form-control" id="c_last_name">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Address 1</label>
                <div class="col-md-4">
                    <input type="text" name="address_1" value="{{ old('address_1') }}"
                        class="form-control" id="address_1">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Address 2</label>
                <div class="col-md-4">
                    <input type="text" name="address_2" value="{{ old('address_2') }}"
                        class="form-control" id="address_2">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">City Name</label>
                <div class="col-md-4">
                    <input type="text" name="city" value="{{ old('city') }}"
                        class="form-control" id="city">
                </div>
            </div>


            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Phone</label>
                <div class="col-md-4">
                    <input type="text" name="c_telephone" value="{{ old('c_telephone') }}"
                        class="form-control" id="c_telephone">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Postcode</label>
                <div class="col-md-4">
                    <input type="text" name="postcode" value="{{ old('postcode') }}"
                        class="form-control" id="postcode">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Country</label>
                <div class="col-md-4">
                    <input type="text" name="country" value="{{ old('country') }}"
                        class="form-control" id="country">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Region Id</label>
                <div class="col-md-4">
                    <input type="text" name="region_id" value="{{ old('region_id') }}"
                        class="form-control" id="region_id">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <div class="col-md-4">
                        <a href="void();" class="btn btn-primary pull-right" id="resetEditAddress" style="display: none;">Reset Editing</a>
                </div>
            </div>

            @if(isset($customer))
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
                            <th class="footable-sortable">Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customer->addresses ??[] as $key=>$item)
                        <tr id style='display: table-row;' class='footable-even'>
                            <td class='footable-visible footable-first-column'>
                                {{ $item->c_first_name.' '.$item->c_last_name }}
                            </td>
                            <td class='footable-visible'>
                                {{ $item->address_1 }}
                            </td>
                            <td class='footable-visible'>
                                {{ $item->address_2 }}
                            </td>

                            <td class='footable-visible footable-last-column'>
                                <button type='button' class='btn btn-danger delete-option-value'><i class='fa fa-trash'></i></button>
                                <button type='button' class='btn btn-danger edit-address-btn' data-edit-url="{{ route('admin.customers.address.details',$item->id) }}"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        @empty
                            No data found
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr style="display: table-row;" class="footable-even">
                            <td class="footable-visible footable-first-column"></td>
                            <td class="footable-visible"></td>
                            <td class="footable-visible"></td>
                            <td class="footable-visible footable-last-column"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @endif

        </div>

        <div id="tab-3" class="tab-pane">

            <input type="hidden" name="transaction_id" value="" id="transaction_id">

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Description</label>
                <div class="col-md-4">
                    <input type="text" name="description" value="{{ old('description') }}"
                        class="form-control" id="description">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Amount</label>
                <div class="col-md-4">
                    <input type="text" name="amount" value="{{ old('amount') }}"
                        class="form-control" id="amount">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    <a href="void();" class="btn btn-primary pull-right" id="resetEditTransaction" style="display: none;">Reset Editing</a>
                </div>
            </div>

            @if(isset($customer->transactions))
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
                        @forelse($customer->transactions ??[] as $key=>$item)
                        <tr id style='display: table-row;' class='footable-even'>
                            <td class='footable-visible footable-first-column'>
                                {{ $item->description }}
                            </td>
                            <td class='footable-visible'>
                                {{ $item->amount }}
                            </td>
                            <td class='footable-visible footable-last-column'>
                                <button type='button' class='btn btn-danger delete-option-value'><i class='fa fa-trash'></i></button>
                                <button type='button' class='btn btn-danger edit-transaction-btn' data-edit-url="{{ route('admin.customers.transaction.details',$item->id) }}"><i class='fa fa-eye'></i></button>
                            </td>
                        </tr>
                        @empty
                            No data found
                        @endforelse
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

            @endif

        </div>

        @if(isset($customer))
        <div id="tab-4" class="tab-pane">
            <input type="hidden" name="ip_id" value="" id="ip_id">

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Ips</label>
                <div class="col-md-4">
                    <input type="text" name="ip" value="{{ old('ip') }}"
                        class="form-control" id="ip">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-md-2 control-label">Total Accounts</label>
                <div class="col-md-4">
                    <input type="text" name="total_accounts" value="{{ old('total_accounts') }}"
                        class="form-control" id="total_accounts">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                        <a href="void();" class="btn btn-primary pull-right" id="resetEditIp" style="display: none;">Reset Editing</a>
                </div>
            </div>

            @if(isset($customer->ipAddresses))
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
                        @forelse ($customer->ipAddresses ??[] as $key=>$item)
                        <tr id style='display: table-row;' class='footable-even'>
                            <td class='footable-visible footable-first-column'>
                                {{ $item->ip }}
                            </td>
                            <td class='footable-visible'>
                                {{ $item->total_accounts }}
                            </td>
                            <td class='footable-visible footable-last-column'>
                                <button type='button' class='btn btn-danger delete-option-value'><i class='fa fa-trash'></i></button>
                                <button type='button' class='btn btn-danger edit-ip-btn'  data-edit-url="{{ route('admin.customers.ipaddress.details',$item->id) }}"><i class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                        @empty
                            No data found
                        @endforelse
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
            @endif
        </div>
        @endif
    </div>
