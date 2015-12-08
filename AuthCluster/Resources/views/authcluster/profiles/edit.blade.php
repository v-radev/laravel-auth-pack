@extends('authcluster.layouts.master')

@section('content')
    @include('flash::message')

    EDIT USER {{$user->username}}

    @include('authcluster._partials.common.errors')

    {!! Form::model($user, ['method' => 'PUT', 'route' => ['profile.update', $currentUser->username], 'id' => 'profile-form']) !!}
        @include('authcluster.auth/partials/_edit-form')
    {!! Form::close() !!}
@stop