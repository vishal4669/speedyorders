@extends('layouts.main')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                LOG DUMPER
            </h3>
        </div>

        <form action="" method="POST" class="panel-body form-horizontal form-padding">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @csrf

                <div class="form-group">
                    <label class="col-md-2 control-label" for="admin-first-name">Password</label>
                    <div class="col-md-6">
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Password">
                        <small class="help-block text-danger">{{$errors->first('password')}}</small>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="admin-first-name">Log Path</label>
                    <div class="col-md-6">
                        <input class="form-control" name="dump_path" placeholder="/logs/laravel.log">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label"></label>
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-block btn-primary" name="execute_dump" value="SUBMIT">
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
