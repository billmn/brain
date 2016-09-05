@extends('vanti::layout')

@section('content')
<div class="home-parallax" style="background: url(http://vantisrl.dev/wp-content/uploads/2014/09/03-2.jpg) center; margin-top: 0; padding: 40px 0;">
    <div class="overlay"></div>
    <h1 class="overlay-title">{{ $page->title }}</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img class="img-responsive" src="{!! $page->primary_image !!}">
        </div>
        <div class="col-md-8">
            {!! $page->content !!}
        </div>
    </div>
</div>
@endsection
