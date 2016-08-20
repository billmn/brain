<li class="dd-item dd3-item" data-id="{{ $page->id }}">
    <div class="dd-handle dd3-handle">
        <i class="move icon"></i>
    </div>

    <div class="dd3-content">
        {{ $page->title }}

        <span class="actions">
            <a href="{{ route('pages.edit', $page->id) }}" class="ui button"><i class="write icon"></i></a>
            {!! Form::delete(route('pages.destroy', $page->id)) !!}
        </span>
    </div>

    @if (count($page->children))
        <ol class="dd-list">
            @foreach($page->children as $page)
                @include('admin.pages.partials.page', $page)
            @endforeach
        </ol>
    @endif
</li>
