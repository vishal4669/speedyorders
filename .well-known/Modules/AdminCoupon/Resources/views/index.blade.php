@extends('layouts.main')

@section('content')
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Coupons List</h4>
            </div>
            <div class="col-md-1 pull-right text-right">
                <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary-fade" data-toggle="tooltip" data-placement="top" data-original-title="Create Coupon">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="col-md-4 pull-right text-right">
                <form method="GET" action="{{ route('admin.coupons.index') }}" accept-charset="UTF-8" role="search">
                    <div class="input-group"><input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                                <button type="button" class="btn btn-primary-fade"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>

        </div>
            <div class="table-responsive">
            <table id="productTable" class="table table-bordered table-striped speedy-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Min Order Amount</th>
                    <th>StartDate</th>
                    <th>ExpiryDate</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->type }}</td>
                    <td>{{ $coupon->amount }}</td>
                    <td>{{ $coupon->min_order_amount }}</td>
                    <td>{{ $coupon->start_date }}</td>
                    <td>{{ $coupon->expiry_date }}</td>
                    <td>
                        {{ $coupon->status=='1' ? 'Active':'Inactive'}}
                        <a href="{{ route('admin.coupons.update.status',$coupon->id) }}" class="text-danger"><strong>Change</strong></a>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.coupons.histories.details',$coupon->code ) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.coupons.edit', $coupon->id ) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button data-toggle="modal" data-target="#delete-modal"
                        data-url="{{route('admin.coupons.delete',$coupon->id)}}"
                        class="btn btn-danger delete">
                        <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tfoot>
                    <tr>
                        <td class="text-center" colspan="10">
                            <span>No data available in the table...</span>
                        </td>
                    </tr>
                </tfoot>
                @endforelse
            </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@include('commons.delete_modal')
@endsection
@section('ext_js')
    <script>
        $(document).on('click', '.delete', function () {
            var actionUrl = $(this).attr('data-url');

            $('#delete-form').attr('action', actionUrl);

            $('#modal-submit').click(function (e) {
                $(this).attr('disabled', true);
                $(this).html('<i class="fa fa-spinner fa-spin" style=""></i> Please Wait...');
                $('#delete-form').submit();
            })
        });
    </script>
@endsection
