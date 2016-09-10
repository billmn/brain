@if ($loop->first or $loop->iteration % 4 == 0)
    <div class="row">
@endif

<div class="service col-md-4">
    <div class="img-wrapper">
        <img class="img-responsive" src="{{ $page->primary_image ? resample($page->primary_image, ['w' => 400]) : Theme::asset('img/placeholder.jpg') }}">
    </div>

    <h4 class="text-uppercase">{{ $page->title }}</h4>
    <div class="service-content">{!! $page->excerpt_or_content !!}</div>
</div>

@if ($loop->iteration % 3 == 0 or $loop->last)
    </div>
@endif
