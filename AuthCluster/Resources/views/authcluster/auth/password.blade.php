@extends('authcluster.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Reset Password</div>
            <div class="panel-body">

                @include('flash::message')

                @include('authcluster._partials.common.errors')

                {!! Form::open(['route' => [ 'auth.password' ], 'id' => 'password-reset-form']) !!}
                    @include('authcluster.auth/partials/_password-form')
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@stop
