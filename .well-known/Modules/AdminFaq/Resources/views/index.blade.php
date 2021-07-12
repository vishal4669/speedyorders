@extends('layouts.main')

@section('content')
<div class="hpanel">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-left text-left">
                <h4>Faq List</h4>
            </div>
            <div class="col-md-1 pull-right text-right">
                <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary-fade" data-toggle="tooltip" data-placement="top" data-original-title="Create Product">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="col-md-1 pull-right text-right">
                <button data-toggle="modal" data-target="#faq-modal"
                    class="btn btn-secondary">
                    <i class="fa fa-download"></i>
                </button>
            </div>
            <div class="col-md-4 pull-right text-right">
                <form method="GET" action="{{ route('admin.faqs.index') }}" accept-charset="UTF-8" role="search">
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
                        <th>Faq Category</th><th>Question</th><th>Answer</th><th>Sort Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faq as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->faqCategory->name ?? '' }}</td><td>{{ $item->question }}</td><td>{{ $item->answer }}</td><td>{{ $item->sort_order }}</td>
                            <td>
                                {{ $item->status=='1' ? 'Active':'Inactive'  }}
                                <a href="{{ route('admin.faqs.update.status',$item->id) }}" class="text-danger"><strong>Change</strong></a>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.faqs.edit', $item->id  ) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button data-toggle="modal" data-target="#delete-modal"
                                    data-url="{{route('admin.faqs.destroy',$item->id)}}"
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
                                <span>{!! $faq->render() !!}</span>
                            </td>
                        </tr>
                    </tfoot>
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('commons.delete_modal')


<div class="modal" id="faq-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6><strong>Make sure that excel is according to provided sample?</strong>
                    <a href="{{storage_path('/excel-sample/faq.xlsx')}}"><strong>sample found here</strong></a>
                </h6>
            </div>
            <form action="{{route('admin.faqs.import')}}" id="faq-category-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="file" class="form-control" name="faq_file" id="faq-category-file">
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" id="faq-modal-submit">Yes</button>
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

        $(document).on('click', '#faq-modal-submit', function () {
            $('#faq-modal-submit').click(function (e) {
                $(this).attr('disabled', true);
                $(this).html('<i class="fa fa-spinner fa-spin" style=""></i> Please Wait...');
               // $('#faq-category-modal').submit();
            })
        });

    </script>
@endsection
