@extends('authcluster.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">

                @include('authcluster._partials.common.errors')

                {!! Form::open(['route' => [ 'auth.register' ], 'id' => 'register-form']) !!}
                    @include('authcluster.auth/partials/_register-form')
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@stop
