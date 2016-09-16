@extends('admin.main')

@section('title', trans('admin.settings.title'))

@section('content')
    {!! Form::model($settings, ['class' => 'ui form']) !!}
        @include('admin.settings.menu')

        <div class="field">
            {!! Form::label(trans('admin.settings.general.fields.website_title')) !!}
            {!! Form::text('website[title]', null, ['autofocus' => true]) !!}
        </div>

        <div class="field">
            {!! Form::label(trans('admin.settings.general.fields.website_footer')) !!}
            {!! Form::wysi('website[footer]') !!}
        </div>

        <h2 class="ui dividing teal header">
            <div class="content">{{ trans('admin.settings.general.scripts') }}</div>
        </h2>

        <div class="field">
            {!! Form::label(trans('admin.settings.general.fields.website_styles')) !!}
            {!! Form::source('website[styles]') !!}
        </div>

        <div class="field">
            {!! Form::label(trans('admin.settings.general.fields.website_scripts')) !!}
            {!! Form::source('website[scripts]') !!}
        </div>

        <button class="ui button primary" type="submit">
            <i class="checkmark icon"></i> {{ trans('admin.actions.save') }}
        </button>
    {!! Form::close() !!}
@endsection
