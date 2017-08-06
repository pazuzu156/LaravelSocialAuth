@extends('layout.main')

@section('content')
<div class="well well-sm">
    {!! Form::open(['class' => 'form-horizontal']) !!}
    <fieldset>
        <legend>Login</legend>
        @if($errors->has('email'))
        <div class="form-group has-error">
        @else
        <div class="form-group">
        @endif
            {!! Form::label('email', 'Email', ['class' => 'col-lg-2']) !!}
            @if($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
            <div class="col-lg-10">
                {!! Form::email('email', '', ['class' => 'form-control']) !!}
            </div>
        </div>
        @if($errors->has('email'))
        <div class="form-group has-error">
        @else
        <div class="form-group">
        @endif
            {!! Form::label('password', 'Password', ['class' => 'col-lg-2']) !!}
            @if($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
            <div class="col-lg-10">
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                Don't have an account? <a href="{{ url('/auth/register') }}">Register</a> now!
            </div>
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
- OR -<br>
<p>Login with one of these social networks <small>(Must have them autorized to your account first)</small></p>
<table>
    <tr>
        <td style="width: 200px;">
            <a href="{{ route('facebook') }}" class="btn-base btn-block btn-social btn-facebook" style="text-decoration: none;">
                <i class="fo-facebook"></i>
                Connect with Facebook
            </a>
        </td>
        <td style="width: 200px; padding-left: 10px;">
            <a href="{{ route('google') }}" class="btn-base btn-block btn-social btn-google" style="text-decoration: none;">
                <i class="fo-google"></i>
                Connect with Google
            </a>
        </td>
        <td style="width: 200px; padding-left: 10px;">
            <a href="{{ route('discord') }}" class="btn-base btn-block btn-social btn-discord" style="text-decoration: none;">
                <i class="fo-discord"></i>
                Connect with Discord
            </a>
        </td>
        <td style="width: 200px; padding-left: 10px;">
            <a href="{{ route('github') }}" class="btn-base btn-block btn-social btn-github" style="text-decoration: none;">
                <i class="fo-github"></i>
                Connect with Github
            </a>
        </td>
    </tr>
</table>
@stop
