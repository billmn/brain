@if ($item->childrens and $item->childrens->count())
    <li class="{{ $item->root ? 'dropdown' : 'dropdown-submenu' }}">
        <a href="{{ $item->url }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            {{ $item->label }} {!! $item->root ? '<b class="caret"></b>' : null !!}
        </a>

        <ul class="dropdown-menu multi-level">
            @each('vanti::partials.menu', $item->childrens, 'item')
        </ul>
    </li>
@else
    <li class="">
        <a href="{{ $item->url }}">{{ $item->label }}</a>
    </li>
@endif
