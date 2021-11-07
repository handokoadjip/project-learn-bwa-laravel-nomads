@extends('layouts.app')

@section('title', 'Details Transactions - Nomads')

@section('content')
    <!-- Main -->
    <main>
        <section class="custom-heading"></section>
        
        <section class="custom-content">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav>
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item">
                                    <a href="">Travel Package</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Details
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-custom">
                            <h1 class="text-capitalize m-0">{{ $travel->title }}</h1>
                            <p>{{ $travel->location }}</p>
                            @if ($travel->photos->count())
                                <div class="gallery">
                                    <div class="xzoom-container">
                                        <img src="{{ Storage::url($travel->photos->first()->path) }}" alt="location" class="xzoom" id="xzoom-default" xoriginal="{{ Storage::url($travel->photos->first()->path) }}">
                                    </div>
                                    <div class="xzoom-thumbs d-flex">
                                        @foreach ($travel->photos as $photo)
                                        <a href="{{ Storage::url($photo->path) }}">
                                            <img src="{{ Storage::url($photo->path) }}" alt="location" class="xzoom-gallery" xpreview="{{ Storage::url($photo->path) }}">
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <h2 class="mt-3 mb-2">Tentang Wisata</h2>
                            <p>{!! $travel->about !!}</p>
                            <div class="features row">
                                <div class="col-md-4 mb-4 mb-md-0 description-container">
                                    <div class="description d-flex ml-0">
                                        <img src="{{ url('frontend/images/ic_event.png') }}" alt="event" class="featured-image align-self-center mb-2 mb-md-0">
                                        <div class="description text-capitalize">
                                            <h3>featured event</h3>
                                            <p>{{ $travel->event }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4 mb-md-0 description-container">
                                    <div class="description d-flex ml-0">
                                        <img src="{{ url('frontend/images/ic_language.png') }}" alt="event" class="featured-image align-self-cen mb-2 mb-md-0ter">
                                        <div class="description text-capitalize">
                                            <h3>language</h3>
                                            <p>{{ $travel->language }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4 mb-md-0 description-container">
                                    <div class="description d-flex ml-0">
                                        <img src="{{ url('frontend/images/ic_food.png') }}" alt="event" class="featured-image align-self-center" mb-2 mb-md-0>
                                        <div class="description text-capitalize">
                                            <h3>foods</h3>
                                            <p>{{ $travel->food }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-3 mt-md-0">
                        <aside class="card card-custom card-right">
                            <h2>Members are going</h2>
                            <div class="members my-2 d-flex align-items-center">
                                <img src="{{ url('frontend/images/member-1.png') }}" alt="member" class="member-image rounded-circle mr-2">
                                <img src="{{ url('frontend/images/member-2.png') }}" alt="member" class="member-image rounded-circle mr-2">
                                <img src="{{ url('frontend/images/member-3.png') }}" alt="member" class="member-image rounded-circle mr-2">
                                <img src="{{ url('frontend/images/member-4.png') }}" alt="member" class="member-image rounded-circle mr-2">
                                <a href=""><div class="member-count rounded-circle d-inline-block">9+</div></a> 
                            </div>
                            <hr />
                            <h2>Trip Information</h2>
                            <table class="trip-informations">
                                <tr>
                                    <th width="50%">Date of Depature</th>
                                    <td width="50%" class="text-right">
                                        {{ \Carbon\Carbon::create($travel->departure)->format('F n, Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Duration</th>
                                    <td width="50%" class="text-right">
                                        {{ $travel->duration }}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Type</th>
                                    <td width="50%" class="text-right">
                                        {{ $travel->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Price</th>
                                    <td width="50%" class="text-right">
                                        $ {{ $travel->price }},00 / person
                                    </td>
                                </tr>
                            </table>
                        </aside>
                        <div class="right-btn-container">
                            @auth
                                <form action="{{ route('checkout.process', $travel->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-block btn-orange right-size" type="submit">Join Now</button>
                                </form>
                            @endauth

                            @guest
                                <a href="{{ route('login') }}" class="btn btn-block btn-orange right-size">Login or Register to Join</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End-Main -->
@endsection

@push('append-style')
    <!-- xzoom -->
    <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css') }}">
@endpush

@push('append-script')
    <!-- XZoom -->
    <script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.xzoom, .xzoom-gallery').xzoom({
                zoomWidth: 300,
                zoomHeight: 200,
                title: false,
                tint: '#333',
                Xoffset: 15
            });
        });
    </script>
@endpush