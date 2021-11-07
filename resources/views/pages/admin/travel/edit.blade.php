@extends('layouts.admin')

@section('title', 'Travel Package : Nomads Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Travel Package {{ $travel->title }}</h1>
        </div>

        <!-- Content Row -->

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('travel.update', $travel->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $travel->title }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ $travel->location }}">
                        @error('location')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea name="about" id="about" rows="10" class="form-control @error('about') is-invalid @enderror">{{ $travel->about }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="event">Event</label>
                        <input type="text" name="event" id="event" class="form-control @error('event') is-invalid @enderror" value="{{ $travel->event }}">
                        @error('event')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="language">Language</label>
                        <input type="text" name="language" id="language" class="form-control @error('language') is-invalid @enderror" value="{{ $travel->language }}">
                        @error('language')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="food">Foods</label>
                        <input type="text" name="food" id="food" class="form-control @error('food') is-invalid @enderror" value="{{ $travel->food }}">
                        @error('food')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="departure">Departure Date</label>
                        <input type="date" name="departure" id="departure" class="form-control @error('departure') is-invalid @enderror" value="{{ $travel->departure }}">
                        @error('departure')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ $travel->duration }}">
                        @error('duration')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ $travel->type }}">
                        @error('type')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input price="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ $travel->price }}">
                        @error('price')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <button class="btn btn-block btn-primary">
                        Edit Data
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection