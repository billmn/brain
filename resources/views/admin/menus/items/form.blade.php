@extends('admin.main')

@section('title', trans('admin.menus_items.title'))
@section('menu', false)
@section('sidebar', false)

@section('main')
<div id="iframe_content">
    @if ($item->exists)
        {!! Form::model($item, ['route' => ['menus.items.update', $menu, $item], 'method' => 'PUT', 'class' => 'ui form']) !!}
    @else
        {!! Form::model($item, ['route' => ['menus.items.store', $menu], 'class' => 'ui form']) !!}
    @endif

    <div class="ui top fixed menu">
        <div class="header item">{{ ucfirst(trans('admin.menus_items.sing')) }}</div>

        <div class="right menu">
            <button class="item primary" type="submit">
                <i class="checkmark icon"></i> {{ trans('admin.actions.save') }}
            </button>
        </div>
    </div>

    <div class="modal-content with-menu">
        {!! Form::hidden('menu_id', $menu->id) !!}
        {!! Form::hidden('type') !!}

        {!! Form::errors() !!}

        <div class="two fields">
            <div class="field">
                {!! Form::label(trans('admin.menus_items.fields.visible_from')) !!}
                {!! Form::datepicker('visible_from') !!}
            </div>
            <div class="field">
                {!! Form::label(trans('admin.menus_items.fields.visible_to')) !!}
                {!! Form::datepicker('visible_to') !!}
            </div>
        </div>

        @if ($item->type === 'page')
            <div id="page_cont">
                <div class="field">
                    {!! Form::label(trans('admin.menus_items.fields.page_id')) !!}
                    {!! Form::select('page_id', $pageList) !!}
                </div>
                <div class="field">
                    {!! Form::label(trans('admin.menus_items.fields.sublevels')) !!}
                    {!! Form::number('sublevels', null, ['min' => 0, 'autocomplete' => 'off']) !!}
                </div>
            </div>
        @else
            <div id="link_cont">
                <div class="field">
                    {!! Form::label(trans('admin.menus_items.fields.label')) !!}
                    {!! Form::text('label', null, ['autofocus' => true]) !!}
                </div>
                <div class="field">
                    {!! Form::label(trans('admin.menus_items.fields.value')) !!}
                    {!! Form::text('value') !!}
                </div>
            </div>
        @endif
    </div>
    {!! Form::close() !!}
</div>
@endsection
