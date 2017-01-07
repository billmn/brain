@extends('auth.main')

@section('title', trans('admin.auth.forgot.title'))

@section('content')
    {!! Form::open(['url' => 'password/email', 'class' => 'ui form auth-forgot']) !!}
        <h2 class="ui teal header">{{ trans('admin.auth.forgot.title') }}</h2>

        {!! Form::errors(['title' => false]) !!}

        @if (session('status'))
            <div class="ui positive message">
                <div class="item">{{ session('status') }}</div>
            </div>
        @endif

        <div class="field">
            {!! Form::label(trans('admin.auth.forgot.email')) !!}
            {!! Form::email('email', null, ['autofocus' => true]) !!}
        </div>

        <div class="buttons">
            <button class="stacked fluid ui teal button" type="submit">
                {{ trans('admin.auth.forgot.send') }}
            </button>

            <a class="fluid ui button" href="{{ url('/login') }}">
                {{ trans('admin.auth.forgot.login') }}
            </a>
        </div>
    {!! Form::close() !!}
@endsection
