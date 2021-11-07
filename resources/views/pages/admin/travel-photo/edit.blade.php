@extends('layouts.admin')

@section('title', 'gallery Package : Nomads Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Photo Travel</h1>
        </div>

        <!-- Content Row -->

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('travel-photo.update', $travelPhoto->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="travel_id">Travel Package</label>
                        <select name="travel_id" id="travel_id" class="form-control">
                            <option value="" selected>Choice Package</option>
                            @foreach ($travels as $travel)
                                <option value="{{ $travel->id }}" {{ $travel->id == $travelPhoto->travel_id ? 'selected' : '' }}>{{ $travel->title }}</option>
                            @endforeach
                        </select>
                        @error('travel_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="photo">Travel Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror">
                        @error('photo')
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