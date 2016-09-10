@extends('vanti::layout')

@section('content')
<div class="home-parallax" style="background: url(http://vantisrl.dev/wp-content/uploads/2014/09/03-2.jpg) center; margin-top: 0; padding: 40px 0;">
    <div class="overlay"></div>
    <h1 class="page-title overlay-title">{{ $page->title }}</h1>
</div>

<div class="container">
    <div class="row">
        @if ($page->primary_image)
            <div class="col-md-4">
                <img class="img-responsive" src="{!! $page->primary_image !!}">
            </div>
        @endif

        <div class="page-content {{ $page->primary_image ? 'col-md-8' : 'col-md-12' }}">
            {!! $page->content !!}
        </div>
    </div>

    @set('descendants', $page->descendants)

    @if ($descendants)
        <div class="page-descendants">
            @foreach($descendants as $descendant)
                @include('vanti::partials.page_grid', ['page' => $descendant])
            @endforeach
        </div>
    @endif
</div>
@endsection
