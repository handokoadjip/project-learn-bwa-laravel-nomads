@extends('layouts.admin')

@section('title', 'Travel Package : Nomads Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Transacation {{ $transaction->user->name }}</h1>
        </div>

        <!-- Content Row -->

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $transaction->id }}</td>
                    </tr>
                    <tr>
                        <th>Travel Package</th>
                        <td>{{ $transaction->travel->title }}</td>
                    </tr>
                    <tr>
                        <th>Buyer</th>
                        <td>{{ $transaction->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Additional Visa</th>
                        <td>${{ $transaction->additional_visa }}</td>
                    </tr>
                    <tr>
                        <th>Total Transaction</th>
                        <td>${{ $transaction->transaction_total }}</td>
                    </tr>
                    <tr>
                        <th>Status Transaction</th>
                        <td>{{ $transaction->transaction_status }}</td>
                    </tr>
                    <tr>
                        <th>Purchasing</th>
                        <td>
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Nationality</th>
                                    <th>Visa</th>
                                    <th>DOE Passport</th>
                                </tr>
                                @foreach ($transaction->details as $detail)
                                    <tr>
                                        <td>{{ $detail->id }}</td>
                                        <td>{{ $detail->username }}</td>
                                        <td>{{ $detail->nationality }}</td>
                                        <td>{{ $detail->is_visa ? '30 Days' : 'N/A' }}</td>
                                        <td>{{ $detail->doe_passport }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection