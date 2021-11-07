@extends('layouts.admin')

@section('title', 'Travel Package : Nomads Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Change Status {{ $transaction->user->name }}</h1>
        </div>

        <!-- Content Row -->

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="transaction_status">Transaction Status</label>
                        <select name="transaction_status" id="transaction_status" class="form-control">
                            <option value="" selected>Choice Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" {{ $status == $transaction->transaction_status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                        @error('transaction_status')
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