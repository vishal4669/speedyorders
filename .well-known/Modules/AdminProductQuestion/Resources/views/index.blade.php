@extends('layouts.main')

@section('content')
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Product Question List</h4>
            </div>
            <div class="col-md-1 pull-right text-right">
                <a href="{{ route('admin.product.questions.create') }}" class="btn btn-primary-fade" data-toggle="tooltip" data-placement="top" data-original-title="Create Product">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="col-md-4 pull-right text-right">
                <form method="GET" action="{{ route('admin.product.questions.index') }}" accept-charset="UTF-8" role="search">
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
                        <th>Product </th><th>Customer </th><th>Name</th><th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productquestion as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->name ?? '' }}</td>
                            <td>{{ $item->customer->name ?? '' }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ ($item->status == 0) ? 'Answered':'Un-answered' }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.product.questions.edit', $item->id  ) }}">
                                    <i class="fa fa-eye">Answer</i>
                                </a>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.product.questions.edit', $item->id  ) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button data-toggle="modal" data-target="#delete-modal"
                                    data-url="{{route('admin.product.questions.destroy',$item->id)}}"
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
                                <span>{!! $productquestion->render() !!}</span>
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
