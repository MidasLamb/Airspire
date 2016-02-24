@extends('app')


@section('content')
    <h1>Welcome {{ $user }} </h1>
    <img src={{ $image }}>
@stop


@section('active-home')
    "active"
@stop