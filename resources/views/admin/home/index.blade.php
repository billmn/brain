@extends('admin.main')

@section('title', trans('admin.home.title'))

@section('content')
<div class="ui grid">
    <div class="sixteen wide column">
        <h2>{{ trans('admin.pages.latest_edited') }}</h2>

        <table class="ui fixed celled striped table">
            <thead>
                <tr>
                    <th>{{ trans('admin.pages.fields.title') }}</th>
                    <th>{{ trans('admin.pages.fields.status') }}</th>
                    <th>{{ trans('admin.common.updated_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                    <tr>
                        <td>
                            <a href="{{ route('pages.edit', $page->id) }}">{{ $page->title }}</a>
                        </td>
                        <td>{{ trans("admin.pages.status.{$page->status}") }}</td>
                        <td>{{ $page->updated_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="3">{{ trans('admin.pages.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot class="full-width">
                <tr>
                    <th>
                        <a href="{{ route('pages.index') }}" class="ui small teal labeled icon button">
                            <i class="right arrow icon"></i> {{ trans('admin.pages.title') }}
                        </div>
                    </th>
                    <th colspan="2">
                        <div class="ui right aligned">
                            <strong>{{ trans('admin.common.total') }}: {{ $pages->count() }}</strong>
                        </div>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    <h2>{{ trans('admin.messages.latest') }}</h2>

    <div class="sixteen wide column">
        <table class="ui fixed celled striped table">
            <thead>
                <tr>
                    <th>{{ trans('admin.messages.fields.email') }}</th>
                    <th>{{ trans('admin.common.updated_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr>
                        <td>
                            <a href="{{ route('messages.edit', $message->id) }}">{{ $message->email }}</a>
                        </td>
                        <td>{{ $message->updated_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="2">{{ trans('admin.messages.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>

            <tfoot class="full-width">
                <tr>
                    <th>
                        <a href="{{ route('messages.index') }}" class="ui small teal labeled icon button">
                            <i class="right arrow icon"></i> {{ trans('admin.messages.title') }}
                        </div>
                    </th>
                    <th>
                        <div class="ui right aligned">
                            <strong>{{ trans('admin.common.total') }}: {{ $messages->count() }}</strong>
                        </div>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
