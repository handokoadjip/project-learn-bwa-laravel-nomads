@extends('layouts.admin')

@section('title', 'Travel Package : Nomads Admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Travel Package</h1>
        <a href="{{ route('travel.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add Travel Package
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
                            <th>Title</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Departure</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @forelse ($travels as $travel)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $travel->title }}</td>
                        <td>{{ $travel->location }}</td>
                        <td>{{ $travel->type }}</td>
                        <td>{{ $travel->departure }}</td>
                        <td>{{ $travel->type }}</td>
                        <td>
                            <a href="{{ route('travel.edit', $travel->id) }}" class="btn btn-info">
                                <i class="fa fa-pencil-alt"></i>
                            </a>

                            <form action="{{ route('travel.destroy', $travel->id) }}" class="d-inline" method="POST">
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