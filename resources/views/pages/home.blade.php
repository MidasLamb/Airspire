@extends('app')

@section('title')
    Home
@stop

@section('uri')
    home
@stop

@section('content')
    <h1>Welcome {{ $user }} </h1>
    <img src={{ $image }}>
@stop


@section('active-home')
    "active"
@stop
