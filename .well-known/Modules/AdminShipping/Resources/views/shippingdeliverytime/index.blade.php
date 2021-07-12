@extends('layouts.main')

@section('content')
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Delivery Time List</h4>
            </div>
            <div class="col-md-1 pull-right text-right">
                <a href="{{ route('admin.deliverytime.create') }}" class="btn btn-primary-fade" data-toggle="tooltip" data-placement="top" data-original-title="Create Coupon">
                    <i class="fa fa-plus"></i>
                </a>
            </div>

        </div>
            <div class="table-responsive">
            <table id="deliverytimeTable" class="table table-bordered table-striped speedy-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Is Enabled</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($deliverytimes as $deliverytime)
                <tr>
                    <td>{{ $deliverytime->name }}</td>
                    <td>
                        {{ $deliverytime->is_available=='1' ? 'Yes':'No'}}
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.deliverytime.edit', $deliverytime->id ) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button data-toggle="modal" data-target="#delete-modal"
                        data-url="{{route('admin.deliverytime.delete',$deliverytime->id)}}"
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
        $(document).ready(function() {
            $('#deliverytimeTable').DataTable({
                "pageLength" : 10
            });
        });

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
