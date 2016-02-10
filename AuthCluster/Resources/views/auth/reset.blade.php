@extends($authViews . 'layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">

                    @include('flash::message')

                    @include($authViews . '_partials.common.errors')

                    Please fill the fields to reset your password.
                    {!! Form::open(['route' => [ $authLoginRoutes . 'reset' ], 'id' => 'password-change-form']) !!}
                    @include($authViews . 'auth.partials._reset-form', ['token' => $token])
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@stop
