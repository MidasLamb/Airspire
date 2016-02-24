@extends('app')


@section('content')
    <img src="https://chart.googleapis.com/chart?chs=150x150&amp;cht=qr&amp;chl={{ $id }},{{ $user }}&amp;choe=UTF-8" alt="QR code">
@stop


@section('active-home')
    "active"
@stop
