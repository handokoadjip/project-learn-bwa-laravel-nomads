@extends('layouts.app-emptystate')

@section('title', 'Checkout Success - Nomads')

@section('content')
    <!-- Main -->
    <main>
        <section class="success d-flex align-items-center align-content-center">
            <div class="col text-center">
                <img src="{{ url('frontend/images/ic_mail.png') }}" alt="mail">
                <h1>Yay! Success</h1>
                <p>We’ve sent you email for trip instruction 
                    <br /> please read it as well</p>
                <a href="{{ route('home') }}" class="btn btn-blue mt-3 px-5">Home Page</a>
            </div>
        </section>
    </main>
    <!-- End-Main -->
@endsection