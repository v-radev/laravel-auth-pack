@extends($authViews . 'layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">

                    @include($authViews . '_partials.common.errors')

                    @include('flash::message')

                    {!! Form::open(['route' => [ $authLoginRoutes . 'login' ], 'id' => 'login-form']) !!}
                    @include($authViews . 'auth.partials._login-form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
