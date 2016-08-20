@extends('admin.main')

@section('title', trans('admin.settings.title'))

@section('content')
    {!! Form::model($settings, ['class' => 'ui form']) !!}
        @include('admin.settings.menu')

        <div class="field">
            {!! Form::label(trans('admin.settings.notfound.fields.title')) !!}
            {!! Form::text('notfound[title]') !!}
        </div>

        <div class="field">
            {!! Form::label(trans('admin.settings.notfound.fields.content')) !!}
            {!! Form::wysi('notfound[content]') !!}
        </div>

        <button class="ui button primary" type="submit">
            <i class="checkmark icon"></i> {{ trans('admin.actions.save') }}
        </button>
    {!! Form::close() !!}
@endsection
