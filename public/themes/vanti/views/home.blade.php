@extends('vanti::layout')

@section('content')
    @inject('menuRepo', 'App\Repositories\MenuRepository')

    @set('menuIntro', $menuRepo->findByName('intro'))
    @set('menuService', $menuRepo->findByName('servizi'))

    <div class="home-carousel">
        <div class="owl-carousel owl-theme">
            @for ($i = 1; $i <= 5; $i++)
                <div class="item owl-lazy" data-src="{{ Theme::asset('img/cover.jpg') }}">
                    <div class="overlay"></div>

                    <div class="slider-caption animated fadeInUp">
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

    <div id="service_section" class="home-parallax" style="background: url({{ Theme::asset('img/excavator.jpg') }}) fixed center;">
        <div class="overlay"></div>
        <h1 class="overlay-title text-uppercase">{{ $menuService->title }}</h1>
    </div>

    <div class="container">
        @foreach ($menuRepo->getItems($menuService->id) as $item)
            @include('vanti::partials.page_grid', ['page' => $item->page])
        @endforeach
    </div>
@endsection
