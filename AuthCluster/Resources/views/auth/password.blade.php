@extends($authViews . 'layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">

                    @include('flash::message')

                    @include($authViews . '_partials.common.errors')

                    {!! Form::open(['route' => [ $authLoginRoutes . 'password' ], 'id' => 'password-reset-form']) !!}
                    @include($authViews . 'auth.partials._password-form')
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@stop
