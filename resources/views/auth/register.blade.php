@extends('layout.main')

@section('content')
<div class="well well-sm">
    {!! Form::open(['class' => 'form-horizontal']) !!}
    <fieldset>
        <legend>Register</legend>
        @if($errors->has('email'))
        <div class="form-group has-error">
        @else
        <div class="form-group">
        @endif
            {!! Form::label('email', 'Email', ['class' => 'col-lg-2 control-label']) !!}
            @if($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
            <div class="col-lg-10">
                {!! Form::email('email', '', ['class' => 'form-control']) !!}
            </div>
        </div>
        @if($errors->has('confirm-email'))
        <div class="form-group has-error">
        @else
        <div class="form-group">
        @endif
            {!! Form::label('confirm-email', 'Confirm Email', ['class' => 'col-lg-2 control-label']) !!}
            @if($errors->has('confirm-email'))
            <span class="text-danger">{{ $errors->first('confirm-email') }}</span>
            @endif
            <div class="col-lg-10">
                {!! Form::email('confirm-email', '', ['class' => 'form-control']) !!}
            </div>
        </div>
        @if($errors->has('password'))
        <div class="form-group has-error">
        @else
        <div class="form-group">
        @endif
            {!! Form::label('password', 'Password', ['class' => 'col-lg-2 control-label']) !!}
            @if($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
            <div class="col-lg-10">
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
        </div>
        @if($errors->has('confirm-password'))
        <div class="form-group has-error">
        @else
        <div class="form-group">
        @endif
            {!! Form::label('confirm-password', 'Confirm Password', ['class' => 'col-lg-2 control-label']) !!}
            @if($errors->has('confirm-password'))
            <span class="text-danger">{{ $errors->first('confirm-password') }}</span>
            @endif
            <div class="col-lg-10">
                {!! Form::password('confirm-password', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                {!! Form::submit('Register', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                Already have an account? <a href="{{ url('/auth/login') }}">Login</a>
            </div>
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@stop
