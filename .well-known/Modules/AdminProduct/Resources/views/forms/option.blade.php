<div class="row">
            <div class="col-md-6">
                <label for="option">Option Required</label>
                <select name="option_required" class="form-control">
                    <option value="1"
                    @if(isset($product->options) && $product->options->first()!=null && $product->options->first()->required ==1) selected @endif>
                    Yes</option>
                    <option value="0"
                    @if(isset($product->options) && $product->options->first()!=null && $product->options->first()->required ==0) selected @endif>
                    No</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="option">Options</label>
                {{-- <input class="form-control" list="options" id="options" placeholder="select option"> --}}
                <select class="form-control " list="options" id="options">
                    <option value="">select options</option>
                    @foreach ($options as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="options-panel">
            @if ($action == 'edit')
                @forelse ($product->options as $counter=>$productOption)
                    @switch($productOption->option->type)
                        @case('input')
                        <div class="hpanel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5><strong>{{ $productOption->option->name }}</strong> </h5>
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
                                                    name="option[input][{{ $productOption->option->id }}]"
                                                    value="{{ $productOption->optionValues->first()->input_value }}" required>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @break
                        @case('select')
                        <div class="hpanel">
                            <input type="text" class="hidden" name="option_id[{{ $counter }}]"
                                value="{{ $option->id }}">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5><strong>{{ $productOption->option->name }}</strong> </h5>
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
                                    <tbody id="tbody{{ $option->id }}">
                                        @foreach ($productOption->optionValues as $productOptionValue)
                                            <tr style="display: table-row;" class="footable-even">
                                                <td class="footable-visible">
                                                    <select name="option[select][option_values][{{ $counter }}][]"
                                                        class="form-control">
                                                        @foreach ($productOption->option->optionValues ?? [] as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $productOptionValue->option_value_id ? 'selected' : '' }}>
                                                                {{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="footable-visible">
                                                    <input type="number" value="{{ $productOptionValue->quantity }}"
                                                        class="form-control"
                                                        name="option[select][quantity][{{ $counter }}][]"
                                                        value="{{ 's' }}" placeholder="Total Option Stock" required>
                                                </td>
                                                <td class="footable-visible">
                                                    <select name="option[select][subtract_from_stock][{{ $counter }}][]"
                                                        class="form-control" required>
                                                        <option value="1" @if ($productOptionValue->subtract_from_stock == 1) selected @endif>Yes</option>
                                                        <option value="0" @if ($productOptionValue->subtract_from_stock == 0) selected @endif>No</option>
                                                    </select>
                                                </td>
                                                <td class="footable-visible">
                                                    <select name="option[select][price_prefix][{{ $counter }}][]"
                                                        class="form-control" required>
                                                        <option value="1"
                                                            {{ $productOptionValue->price_prefix == '1' ? 'selected' : '' }}>+
                                                        </option>
                                                        <option value="0"
                                                            {{ $productOptionValue->price_prefix == '0' ? 'selected' : '' }}>-
                                                        </option>
                                                    </select>

                                                </td>
                                                <td class="footable-visible">
                                                    <input type="number" value="{{ $productOptionValue->price }}"
                                                        class="form-control"
                                                        name="option[select][price][{{ $counter }}][]" placeholder="Price"
                                                        required>
                                                </td>
                                                <td class="footable-visible footable-last-column"><a
                                                        class="remove-option-value btn btn-danger"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="display: table-row;" class="footable-even">
                                            <td class="footable-visible" colspan="5"></td>
                                            <td class="footable-visible footable-last-column"><a
                                                    class="btn btn-primary add-option-value"
                                                    data-option-id="{{ $option->id }}"><i class="fa fa-plus"></i></a>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        @break
                    @endswitch
                @empty
            @endforelse
            @endif
        </div>
