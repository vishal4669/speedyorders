@extends('layouts.main')

@section('content')
    <div class="row">
        @include('adminsetting::sidebar')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Stripe Information</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.settings.update.stripe') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group{{ $errors->has('stripe_key') ? ' has-error' :'' }}">
                            <label for="">Client Id</label>
                            <input type="text" name="stripe_key" id="" class="form-control" value="{{ old('stripe_key',Option::get('stripe_key')) }}">
                            @if($errors->has('stripe_key'))
                                <span class="help-block">{{ $errors->first('stripe_key') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('stripe_secret') ? ' has-error' :'' }}">
                            <label for="">Secret key</label>
                            <input type="text" name="stripe_secret" id="" class="form-control" value="{{ old('stripe_secret',Option::get('stripe_secret')) }}">
                            @if($errors->has('stripe_secret'))
                                <span class="help-block">{{ $errors->first('stripe_secret') }}</span>
                            @endif
                        </div>

                        <div class="col-md-12 text-right">
                            @csrf
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
