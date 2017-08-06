@extends('layout.main')

@section('content')

<p>Welcome! Use the buttons below to connect your account to various social networks. You can login with them once you authorize them</p>

@include('social.facebook')
<br>
@include('social.google')
<br>
@include('social.discord')
<br>
@include('social.github')

@stop
