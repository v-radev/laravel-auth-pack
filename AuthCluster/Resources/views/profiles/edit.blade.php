@extends($authViews . 'layouts.master')

@section('content')
    @include('flash::message')

    EDIT USER {{$user->username}}

    @include($authViews . '_partials.common.errors')

    {!! Form::model($user, ['method' => 'PUT', 'route' => [$authProfileRoutes . 'update', $currentUser->username], 'id' => 'profile-form']) !!}
    @include($authViews . 'auth.partials._edit-form')
    {!! Form::close() !!}
@stop