@extends('layouts.main')

@section('content')
    <div class="row">
        @include('adminsetting::sidebar')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Paypal Information</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.settings.update.paypal') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <h3>For Live</h3>

                        <div class="form-group{{ $errors->has('paypal_live_client_id') ? ' has-error' :'' }}">
                            <label for="">Client Id</label>
                            <input type="text" name="paypal_live_client_id" id="" class="form-control" value="{{ old('paypal_live_client_id',Option::get('paypal_live_client_id')) }}">
                            @if($errors->has('paypal_live_client_id'))
                                <span class="help-block">{{ $errors->first('paypal_live_client_id') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('paypal_live_secret_key') ? ' has-error' :'' }}">
                            <label for="">Secret key</label>
                            <input type="text" name="paypal_live_secret_key" id="" class="form-control" value="{{ old('paypal_live_secret_key',Option::get('paypal_live_secret_key')) }}">
                            @if($errors->has('paypal_live_secret_key'))
                                <span class="help-block">{{ $errors->first('paypal_live_secret_key') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('papapal_live_currency') ? ' has-error' :'' }}">
                            <label for="">Currency</label>
                            <input type="text" name="papapal_live_currency" id="" class="form-control" value="{{ old('papapal_live_currency',Option::get('papapal_live_currency')) }}">
                            @if($errors->has('papapal_live_currency'))
                                <span class="help-block">{{ $errors->first('papapal_live_currency') }}</span>
                            @endif
                        </div>

                        <h3>For Sandbox</h3>
                        <div class="form-group{{ $errors->has('paypal_sandbox_client_id') ? ' has-error' :'' }}">
                            <label for="">Client Id</label>
                            <input type="text" name="paypal_sandbox_client_id" id="" class="form-control" value="{{ old('paypal_sandbox_client_id',Option::get('paypal_sandbox_client_id')) }}">
                            @if($errors->has('paypal_sandbox_client_id'))
                                <span class="help-block">{{ $errors->first('paypal_sandbox_client_id') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('paypal_sandbox_secret_key') ? ' has-error' :'' }}">
                            <label for="">Secret key</label>
                            <input type="text" name="paypal_sandbox_secret_key" id="" class="form-control" value="{{ old('paypal_sandbox_secret_key',Option::get('paypal_sandbox_secret_key')) }}">
                            @if($errors->has('paypal_sandbox_secret_key'))
                                <span class="help-block">{{ $errors->first('paypal_sandbox_secret_key') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('paypal_sandbox_currency') ? ' has-error' :'' }}">
                            <label for="">Currency</label>
                            <input type="text" name="paypal_sandbox_currency" id="" class="form-control" value="{{ old('paypal_sandbox_currency',Option::get('paypal_sandbox_currency')) }}">
                            @if($errors->has('paypal_sandbox_currency'))
                                <span class="help-block">{{ $errors->first('paypal_sandbox_currency') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">API mode</label>
                            <div class="checkbox">
                                <input id="status" class="i-checks" type="radio" name="paypal_api_mode" value="LIVE" @if(old('paypal_api_mode',Option::get('paypal_api_mode'))=='LIVE') checked @endif>
                                <label for="status" style="color:#000000;">Live</label>
                                <input id="status-2" class="i-checks" type="radio" name="paypal_api_mode" value="SANDBOX" @if(old('paypal_api_mode',Option::get('paypal_api_mode'))=='SANDBOX') checked @endif>
                                <label for="status-2" style="color:#000000;">Sandbox</label>
                            </div>
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
