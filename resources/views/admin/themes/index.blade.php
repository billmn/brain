@extends('admin.main')

@section('title', trans('admin.themes.title'))

@section('content')
<div id="themes_cont" class="ui basic segment">
    <div class="ui special cards">
        @foreach($themes as $name)
            <div class="card">
                <div class="blurring dimmable image">
                    <div class="ui dimmer">
                        <div class="content">
                            <div class="center">
                                @if ($name === $active)
                                    <div class="ui primary button">{{ trans('admin.themes.current') }}</div>
                                @else
                                    {!! Form::open(['route' => ['themes.update', $name], 'method' => 'PUT', 'class' => 'ui form']) !!}
                                        {!! Form::submit(trans('admin.themes.enable'), ['class' => 'ui inverted button']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                    </div>

                    <?php $imagePath = "/".config('themes.paths.base')."/{$name}/theme.jpg"; ?>
                    <?php $imageDefault = "/assets/img/theme.jpg"; ?>

                    <img src="{{ file_exists(public_path($imagePath)) ? $imagePath : $imageDefault }}">
                </div>

                <div class="content">
                    <div class="header">
                        {{ Theme::getProperty("{$name}::name") }}

                        @if ($name === $active)
                            <div class="ui blue empty circular label"></div>
                        @endif
                    </div>
                    <div class="meta">
                        <span class="author">{{ Theme::getProperty("{$name}::author") }}</span>
                    </div>
                </div>
                <div class="extra content">
                    {{ Theme::getProperty("{$name}::description") }}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
