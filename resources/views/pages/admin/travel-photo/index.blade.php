@extends('layouts.admin')

@section('title', 'Travel Photo : Nomads Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Travel Photo</h1>
            <a href="{{ route('travel-photo.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add Travel Photo
            </a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Travel</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @forelse ($travelPhotos as $travelPhoto)
                            <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $travelPhoto->travel->title }}</td>
                                    <td>
                                        <img src="{{ Storage::url($travelPhoto->path) }}" alt="{{ $travelPhoto->travel->title }}" width="150" class="img-thumbnail">
                                    </td>
                                    <td>
                                        <a href="{{ route('travel-photo.edit', $travelPhoto->id) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>

                                        <form action="{{ route('travel-photo.destroy', $travelPhoto->id) }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Empty</td>
                            </tr>
                        @endforelse
                    
                            <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection