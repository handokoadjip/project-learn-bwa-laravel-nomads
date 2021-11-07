@extends('layouts.app')

@section('title', 'NOMADS')

@section('content')
    <!-- Header -->
    <header class="text-center">
        <h1>Explore The Beautiful World
            <br />As Easy One Click</h1>
        <p class="mt-3">You will see beautiful
            <br />moment you never see before</p>
        <a href="#popular-content" class="btn btn-orange get-started-size mt-4 px-4">Get Started</a>
    </header>
    <!-- End-Header -->

    <!-- Main -->
    <main>
        <section class="stats" id="stats">
            <div class="container">
                <div class="stats-bar row justify-content-center">
                    <div class="col-6 col-md-2 text-center text-md-left stats-detail">
                        <h2>20K</h2>
                        <p>Members</p>
                    </div>
                    <div class="col-6 col-md-2 text-center text-md-left stats-detail">
                        <h2>12</h2>
                        <p>Countries</p>
                    </div>
                    <div class="col-6 col-md-2 text-center text-md-left stats-detail">
                        <h2>3K</h2>
                        <p>Hotel</p>
                    </div>
                    <div class="col-6 col-md-2 text-center text-md-left stats-detail">
                        <h2>72</h2>
                        <p>Partners</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="popular-heading">
            <div class="container">
                <div class="row">
                    <div class="col text-center title-heading popular-title">
                        <h2>Popular Travel</h2>
                        <p>
                            Something that you never try
                            <br /> before in this world
                        </p>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="popular-content" id="popular-content">
            <div class="container">
                <div class="popular-travel row justify-content-center">
                    @foreach ($travels as $travel)
                    <div class="col-md-6 col-lg-3">
                        <div class="card-travel text-center d-flex flex-column" style="background-image: url({{ $travel->photos->count() ? asset('storage/' . $travel->photos->first()->path) : '' }});">
                            <div class="travel-country text-uppercase">{{ $travel->location }}</div>
                            <div class="travel-location text-uppercase">{{ $travel->title }}</div>
                            <div class="travel-button mt-auto">
                                <a href="{{ route('detail', $travel->slug) }}" class="btn btn-orange travel-size px-4">
                                    View Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="networks">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-md-4 align-self-center text-center text-lg-left mb-5 mb-lg-0 title-heading">
                        <h2>Our Network</h2>
                        <p>Companies are trusted us
                            <br /> more than just a trip</p>
                    </div>
                    <div class="col-md-2 align-self-center text-center text-lg-left mb-5 mb-lg-0">
                        <img src="{{ url('frontend/images/logo_network-1.png') }}" alt="logo network 1">
                    </div>
                    <div class="col-md-2 align-self-center text-center text-lg-left mb-5 mb-lg-0">
                        <img src="{{ url('frontend/images/logo_network-2.png') }}" alt="logo network 1">
                    </div>
                    <div class="col-md-2 align-self-center text-center text-lg-left mb-5 mb-lg-0">
                        <img src="{{ url('frontend/images/logo_network-3.png') }}" alt="logo network 1">
                    </div>
                    <div class="col-md-2 align-self-center text-center text-lg-left mb-5 mb-lg-0">
                        <img src="{{ url('frontend/images/logo_network-4.png') }}" alt="logo network 1">
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonial-heading">
            <div class="container">
                <div class="row">
                    <div class="col text-center title-heading">
                        <h2>Hear Them</h2>
                        <p>Moments were giving them 
                            <br />the best experience</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonial-content">
            <div class="container">
                <div class="testimonial-travel row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-testimonial text-center">
                            <div class="travel-content">
                                <img src="{{ url('frontend/images/user_pic-1.png') }}" alt="user" class="mb-4 rounded-circle">
                                <h3 class="mb-3">Shayna</h3>
                                <q class="testimonial">
                                    The trip was amazing and
                                    I saw something beautiful in
                                    that Island that makes me
                                    want to learn more
                                </q>
                            </div>
                            <hr />
                            <p class="trip-to mt-3">
                                Trip to Karimun Jawa
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-testimonial text-center">
                            <div class="travel-content">
                                <img src="{{ url('frontend/images/user_pic-2.png') }}" alt="user" class="mb-4 rounded-circle">
                                <h3 class="mb-3">Shabrina</h3>
                                <q class="testimonial">
                                    I loved it when the waves
                                    was shaking harder — I was
                                    scared too
                                </q>
                            </div>
                            <hr />
                            <p class="trip-to mt-3">
                                Trip to Karimun Jawa
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-testimonial text-center">
                            <div class="travel-content">
                                <img src="{{ url('frontend/images/user_pic-3.png') }}" alt="user" class="mb-4 rounded-circle">
                                <h3 class="mb-3">Angga Risky</h3>
                                <q class="testimonial">
                                    It was glorious and I could 
                                    not stop to say wohooo for  
                                    every single moment
                                    Dankeeeeee
                                </q>
                            </div>
                            <hr />
                            <p class="trip-to mt-3">
                                Trip to Ubud
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="#" class="btn btn-help px-4 mt-5 mx-1">I Need Help</a>
                        <a href="{{ route('register') }}" class="btn btn-orange started-size px-4 mt-5 mx-1">Get Started</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End-Main -->
@endsection