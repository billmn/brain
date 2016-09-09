@extends('vanti::layout')

@section('content')
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
            <h2>PERCHÈ SCEGLIERCI?</h2>
            <hr>
        </div>

        <h3 class="section-subtitle">Garanzia di successo</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </section>
</div>

<div class="home-parallax" style="background: url({{ Theme::asset('img/excavator.jpg') }}) fixed center;">
    <div class="overlay"></div>
    <h1 class="overlay-title">I NOSTRI SERVIZI</h1>
</div>

<div class="container">
    <div class="row">
        @inject('menuRepo', 'App\Repositories\MenuRepository')
        @set('menu', $menuRepo->findByName('servizi'))

        @foreach ($menuRepo->getItems($menu->id) as $item)
            <div class="service col-md-4">
                <div class="img-wrapper">
                    <img class="img-responsive" src="http://vantisrl.dev/wp-content/uploads/2014/09/03-2.jpg">
                </div>

                <h4>{{ $item->page->title }}</h4>
                <p>{!! $item->page->excerpt_or_content !!}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
