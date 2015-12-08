@extends('authcluster.layouts.master')

@section('content')
    <h3>Profile of user <b>{{$user->username}}</b></h3>
    <ul>
        @if($user->name)
            <li>Name: <b>{{$user->name}}</b></li>
        @endif
    </ul>
@stop