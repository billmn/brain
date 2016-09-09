@extends('vanti::layout')

@section('content')
    @inject('menuRepo', 'App\Repositories\MenuRepository')

    @set('menuIntro', $menuRepo->findByName('intro'))
    @set('menuServizi', $menuRepo->findByName('servizi'))

    <div class="home-carousel">
        <div class="owl-carousel owl-theme">
            @for ($i = 1; $i <= 5; $i++)
                <div class="item owl-lazy" data-src="{{ Theme::asset('img/cover.jpg') }}">
                    <div class="overlay"></div>

                    <div class="slider-caption">
                        <h2 class="title">PRODUZIONE E COMMERCIO INERTI {{ $i }}</h2>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div class="container">
        <section class="home-section">
            <div class="title">
                <h2 class="text-uppercase">{{ $menuIntro->title }}</h2>
                <hr>
            </div>

            @foreach ($menuRepo->getItems($menuIntro->id) as $item)
                <h3 class="section-subtitle">{{ $item->page->title }}</h3>
                <div class="section-content">{!! $item->page->excerpt_or_content !!}</div>
            @endforeach
        </section>
    </div>

    <div class="home-parallax" style="background: url({{ Theme::asset('img/excavator.jpg') }}) fixed center;">
        <div class="overlay"></div>
        <h1 class="overlay-title text-uppercase">{{ $menuServizi->title }}</h1>
    </div>

    <div class="container">
        @foreach ($menuRepo->getItems($menuServizi->id) as $item)
            @if ($loop->first or $loop->iteration % 4 == 0)
                <div class="row">
            @endif

            <div class="service col-md-4">
                <div class="img-wrapper">
                    <img class="img-responsive" src="{{ Theme::asset('img/service.jpg') }}">
                </div>

                <h4 class="text-uppercase">{{ $item->page->title }}</h4>
                <div class="service-content">{!! $item->page->excerpt_or_content !!}</div>
            </div>

            @if ($loop->iteration % 3 == 0 or $loop->last)
                </div>
            @endif
        @endforeach
    </div>
@endsection
