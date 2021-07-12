@extends('layouts.main')

@section('content')
@include('adminorder::message')
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Orders List</h4>
            </div>
            <div class="col-md-1 pull-right text-right">
                <a href="{{ route('admin.orders.create') }}" class="btn btn-primary-fade" data-toggle="tooltip" data-placement="top" data-original-title="Create Product">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="col-md-4 pull-right text-right">
                <form method="GET" action="{{ route('admin.orders.index') }}" accept-charset="UTF-8" role="search">
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
                        <th>#</th>
                        <th>Customer User</th><th>Invoice Number</th><th>Invoice Prefix</th><th>First Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->customerUser->customer->first_name.' '.$item->customerUser->customer->last_name}}</td>
                            <td>{{ $item->invoice_number }}</td>
                            <td>{{ $item->invoice_prefix }}</td>
                            <td>{{ $item->first_name }}</td>
                            <td>
                                {{ $item->status=='1' ? 'Active':'Inactive'  }}
                                <a href="{{ route('admin.orders.update.status',$item->id) }}" class="text-danger"><strong>Change</strong></a>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" title="view" href="{{ route('admin.orders.show', $item->id  ) }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a class="btn btn-success btn-sm"  title="report" href="{{ route('admin.orders.invoices.show', $item->id  ) }}">
                                    <i class="fa fa-file"></i>
                                </a>
                                <a class="btn btn-primary btn-sm" title="edit" href="{{ route('admin.orders.edit', $item->id  ) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button data-toggle="modal"  title="delete" data-target="#delete-modal"
                                    data-url="{{route('admin.orders.delete',$item->id)}}"
                                    class="btn btn-danger delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="7">
                            <span>No data available in the table...</span>
                        </td>
                    </tr>
                    @endforelse
                    <tfoot>
                        <tr>
                            <td class="text-center" colspan="7">
                                <span>{!! $orders->render() !!}</span>
                            </td>
                        </tr>
                    </tfoot>
                </tbody>
            </table>
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
