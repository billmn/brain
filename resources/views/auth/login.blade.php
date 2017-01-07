@extends('auth.main')

@section('title', trans('admin.auth.login.title'))

@section('content')
    {!! Form::open(['url' => 'login', 'class' => 'ui form auth-signin']) !!}
        <h2 class="ui teal header">{{ trans('admin.auth.login.title') }}</h2>

        {!! Form::errors(['title' => false]) !!}

        <div class="field">
            {!! Form::label(trans('admin.auth.login.email')) !!}
            {!! Form::email('email', null, ['autofocus' => true]) !!}
        </div>

        <div class="field">
            {!! Form::label(trans('admin.auth.login.password')) !!}
            {!! Form::password('password') !!}
        </div>

        <div class="field">
            <div class="ui checkbox">
                {!! Form::checkbox('remember') !!}
                <label>{{ trans('admin.auth.login.remember') }}</label>
            </div>
        </div>

        <div class="buttons">
            <button class="stacked fluid ui teal button" type="submit">
                {{ trans('admin.auth.login.signin') }}
            </button>

            <a class="fluid ui button" href="{{ url('/password/reset') }}">
                {{ trans('admin.auth.login.forgot') }}
            </a>
        </div>
    {!! Form::close() !!}
@endsection
