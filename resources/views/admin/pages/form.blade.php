@extends('admin.main')

@section('title', trans('admin.pages.title'))

@section('content')
    @if ($page->exists)
        {!! Form::model($page, ['route' => ['pages.update', $page->id], 'method' => 'PUT', 'class' => 'ui form']) !!}
    @else
        {!! Form::model($page, ['route' => 'pages.store', 'class' => 'ui form']) !!}
    @endif

        {!! Form::errors() !!}
        {!! Form::hidden('parent_id') !!}

        <div class="field">
            {!! Form::label(trans('admin.pages.fields.title')) !!}

            <div class="ui big input">
                {!! Form::text('title', null, ['autofocus' => true]) !!}
            </div>

            @if ($page->exists)
            <div class="page-link">
                <i class="external icon"></i> <a class="item" href="{{ $page->url }}" target="_blank">{{ $page->url }}</a>
            </div>
            @endif
        </div>

        <div class="ui top attached tabular menu" data-cookie="admin_page_tab">
            <a class="item active" data-tab="info">{{ trans('admin.pages.tabs.info') }}</a>
            <a class="item" data-tab="contents">{{ trans('admin.pages.tabs.contents') }}</a>
        </div>

        <div class="ui bottom attached tab segment active" data-tab="info">
            <div class="ui grid">
                <div class="ten wide column">
                    <div class="field">
                        {!! Form::label(trans('admin.pages.fields.status')) !!}
                        {!! Form::select('status', $statusList, $page->status ?: $page::STATUS_PUBLISHED) !!}
                    </div>

                    <div class="two fields">
                        <div class="field">
                            {!! Form::label(trans('admin.pages.fields.publish_start')) !!}
                            {!! Form::datepicker('publish_start') !!}
                        </div>

                        <div class="field">
                            {!! Form::label(trans('admin.pages.fields.publish_end')) !!}
                            {!! Form::datepicker('publish_end') !!}
                        </div>
                    </div>

                    <div class="two fields">
                        <div class="field">
                            {!! Form::label(trans('admin.pages.fields.form_id')) !!}
                            {!! Form::select('form_id', $formList) !!}
                        </div>

                        <div class="field">
                            {!! Form::label(trans('admin.pages.fields.template')) !!}
                            {!! Form::select('template', $templatesList) !!}
                        </div>
                    </div>

                    <div class="two fields">
                        <div class="field">
                            {!! Form::label(trans('admin.pages.fields.primary_image')) !!}
                            {!! Form::media('primary_image', null, [
                                'type' => 'image',
                                'v-model' => 'primary_image',
                                'data-index' => 0,
                            ]) !!}
                        </div>

                        <div class="field">
                            {!! Form::label(trans('admin.pages.fields.secondary_image')) !!}
                            {!! Form::media('secondary_image', null, [
                                'type' => 'image',
                                'v-model' => 'secondary_image',
                                'data-index' => 1,
                            ]) !!}
                        </div>
                    </div>

                    <div class="field">
                        {!! Form::label(trans('admin.pages.fields.gallery')) !!}
                        {!! Form::media('gallery', null, [
                            'type' => 'image',
                            'append' => true,
                            'v-model' => 'gallery',
                            'multiple' => true,
                            'data-index' => 2,
                        ]) !!}
                    </div>
                </div>
                <div class="six wide column">
                    <div class="ui styled accordion">
                        <div class="active title">
                            <i class="dropdown icon"></i>
                            {!! Form::label(trans('admin.pages.fields.primary_image')) !!}
                        </div>
                        <div class="active content">
                            <image-preview :file="primary_image"></image-preview>
                        </div>
                        <div class="title">
                            <i class="dropdown icon"></i>
                            {!! Form::label(trans('admin.pages.fields.secondary_image')) !!}
                        </div>
                        <div class="content">
                            <image-preview :file="secondary_image"></image-preview>
                        </div>
                        <div class="title">
                            <i class="dropdown icon"></i>
                            {!! Form::label(trans('admin.pages.fields.gallery')) !!}
                        </div>
                        <div class="content">
                            <div class="gallery-cont centered">
                                <gallery-preview v-for="image in gallery.split(',')" :file="image"></gallery-preview>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui bottom attached tab segment" data-tab="contents">
            <div class="field">
                {!! Form::label(trans('admin.pages.fields.content')) !!}
                {!! Form::wysi('content') !!}
            </div>

            <div class="inline field">
                <div class="ui checkbox">
                    {!! Form::checkbox('custom_excerpt', true, null, ['v-model' => 'show_excerpt']) !!}
                    {!! Form::label(trans('admin.pages.fields.custom_excerpt')) !!}
                </div>
            </div>

            <div class="field" v-show="show_excerpt">
                {!! Form::label(trans('admin.pages.fields.excerpt')) !!}
                {!! Form::wysi('excerpt') !!}
            </div>
        </div>

        <a class="ui button" href="{{ route('pages.index') }}">
            <i class="angle left icon"></i> {{ trans('admin.actions.back') }}
        </a>

        <button class="ui button primary" type="submit">
            <i class="checkmark icon"></i> {{ trans('admin.actions.save') }}
        </button>

    {!! Form::close() !!}
@endsection

@section('scripts')
<script>
    $('.field-image input').on('change focus', function() {
        $('.ui.accordion').accordion('open', $(this).data('index'));
    });

    new Sortable($('.gallery-cont').get(0), {
        onUpdate: function(e) {
            $('input[name=gallery]').val(this.toArray().join(','));
        }
    });
</script>
@endsection
