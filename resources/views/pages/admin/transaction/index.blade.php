@extends('layouts.admin')

@section('title', 'Transaction Package : Nomads Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transaction Package</h1>
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
                                <th>User</th>
                                <th>Visa</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->travel->title }}</td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>${{ $transaction->additional_visa }}</td>
                                    <td>${{ $transaction->transaction_total }}</td>
                                    <td>{{ $transaction->transaction_status }}</td>
                                    <td>
                                        <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('transaction.edit', $transaction->id) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>

                                        <form action="{{ route('transaction.destroy', $transaction->id) }}" class="d-inline" method="POST">
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