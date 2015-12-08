@extends('authcluster.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">

                @include('authcluster._partials.common.errors')
                @include('flash::message')

                {!! Form::open(['route' => [ 'auth.login' ], 'id' => 'login-form']) !!}
                    @include('authcluster.auth/partials/_login-form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
