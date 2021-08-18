@extends('layouts.main')

@section('content')
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Attribute List</h4>
            </div>
             <div class="col-md-4 pull-left text-right">
                <form method="GET" action="{{ route('admin.product.attributes.index') }}" accept-charset="UTF-8" role="search">
                    <div class="input-group"><input type="text" class="form-control" placeholder="Search" name="keyword">
                        <span class="input-group-btn">
                                <button type="button" class="btn btn-primary-fade"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>

            <div class="col-md-1 pull-right text-right">
                

                <button data-toggle="modal" data-target="#attribute-modal"
                    class="btn btn-secondary">
                    <i class="fa fa-download"></i>
                </button>

                <a href="{{ route('admin.product.attributes.create') }}" class="btn btn-primary-fade" data-toggle="tooltip" data-placement="top" data-original-title="Create Product">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            
        </div>
        <div class="table-responsive">
            <table id="productTable" class="table table-bordered table-striped speedy-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Attribute Values</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attributes as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->attribute_label }}</td>
                            <td>{{ $item->input_type }}</td>
                            <td>
                                @if(!empty($item->attributeValues))
                                    @foreach($item->attributeValues as $attr_value)
                                        {{$attr_value->name}} <br>
                                    @endforeach
                                @endif

                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.product.attributes.edit', $item->id  ) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button data-toggle="modal" data-target="#delete-modal"
                                    data-url="{{route('admin.product.attributes.delete',$item->id)}}"
                                    class="btn btn-danger delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="6">
                            <span>No data available in the table...</span>
                        </td>
                    </tr>
                    @endforelse
                    <tfoot>
                        <tr>
                            <td class="text-center" colspan="6">
                                <span>{!! $attributes->render() !!}</span>
                            </td>
                        </tr>
                    </tfoot>
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('commons.delete_modal')


<div class="modal" id="attribute-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6><strong>Make sure that csv file is according to provided sample?</strong>
                    <a href="{{url('/Attributes_Sample.csv')}}"><strong>sample found here</strong></a>
                </h6>
            </div>
            <form action="{{route('admin.product.attributes.import')}}" id="attribute-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="file" class="form-control" name="attribute_file" id="attribute-file">
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" id="attribute-modal-submit">Import</button>
                </div>
            </form>

        </div>
    </div>
</div>
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

        $(document).on('click', '#attribute-modal-submit', function () {
          
                $(this).attr('disabled', true);
                $(this).html('<i class="fa fa-spinner fa-spin" style=""></i> Please Wait...');
               $('#attribute-form').submit();
            
        });

    </script>
@endsection
