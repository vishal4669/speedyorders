@extends('layouts.main')

@section('content')
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Coupons History List</h4>
            </div>

            <div class="col-md-4 pull-right text-right">
                <form method="GET" action="{{ route('admin.coupons.histories.index') }}" accept-charset="UTF-8" role="search">
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
                    <th>Coupon Code</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($couponHistories as $couponHistory)
                <tr>
                    <td>{{ $couponHistory->coupon_code }} </td>
                    <td>{{ $couponHistory->total }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.coupons.histories.details',$couponHistory->coupon_code ) }}">
                            <i class="fa fa-eye"></i>
                        </a>
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
@endsection
@section('ext_js')
    <script>
    </script>
@endsection
