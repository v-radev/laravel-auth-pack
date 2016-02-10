@extends($authViews . 'layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">

                    @include($authViews . '_partials.common.errors')

                    {!! Form::open(['route' => [ $authLoginRoutes . 'register' ], 'id' => 'register-form']) !!}
                    @include($authViews . 'auth.partials._register-form')
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@stop
