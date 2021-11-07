@extends('layouts.app-transaction')

@section('title', 'Checkout - Nomads')

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
                                    <a href="#">Travel Package</a>
                                </li>
                                <li class="breadcrumb-item">
                                    Details
                                </li>
                                <li class="breadcrumb-item active">
                                    Checkout
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-custom">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h1 class="m-0">Who is Going?</h1>
                            <p>Trip to {{ $transaction->travel->title }}, {{ $transaction->travel->location }}</p>
                            <div class="attendee-member">
                                <table class="table table-responsive-sm text-center">
                                    <thead>
                                        <tr>
                                            <td>Picture</td>
                                            <td>Name</td>
                                            <td>Nationality</td>
                                            <td>Visa</td>
                                            <td>Passport</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transaction->details as $detail)
                                            <tr>
                                                <td><img src="https://ui-avatars.com/api/?name={{ $detail->username }}" alt="{{ $detail->username }}" height="60" class="rounded-circle"></td>
                                                <td class="align-middle">{{ $detail->username }}</td>
                                                <td class="align-middle">{{ $detail->nationality }}</td>
                                                <td class="align-middle">{{ $detail->is_visa ? '30 Days' : 'N/A' }}</td>
                                                <td class="align-middle">
                                                    {{ \Carbon\carbon::createFromDate($detail->doe_passport) > \Carbon\carbon::now() ? 'Active' : 'Inactive' }}
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('checkout.remove', $detail->id) }}"><i class="fas fa-times delete-attendee"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No Visitor</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="attendee-form mt-3">
                                <h2>Add Member</h2>
                                <form action="{{ route('checkout.create', $transaction->id) }}" class="form-inline" method="POST">
                                    @csrf
                                    <label for="username" class="sr-only">Name</label>
                                    <input type="text" name="username" id="username" class="form-control mb-2 mr-sm-2" placeholder="Username">

                                    <label for="nationality" class="sr-only">Nationality</label>
                                    <input type="text" name="nationality" id="nationality" class="form-control mb-2 mr-sm-2" placeholder="Nationality" style="width: 50px">
                                    
                                    <label for="is_visa" class="sr-only">Visa</label>
                                    <select name="is_visa" id="" class="custom-select mb-2 mr-sm-2">
                                        <option value="" selected>Visa</option>
                                        <option value="1">30 Days</option>
                                        <option value="0">N/A</option>
                                    </select>

                                    <label for="doe_passport" class="sr-only">DOE Passport</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" name="doe_passport" id="doe_passport" class="form-control datepicker" placeholder="DOE Passport" style="width: 100px">
                                    </div>

                                    <button type="submit" class="btn btn btn-blue mb-2 mt-2 mt-md-0 px-4">
                                        Add Now
                                    </button>
                                </form>
                                <h3 class="mt-2 mb-0">Note</h3>
                                <p class="mb-0">
                                    You are only able to invite member that has registered in Nomads.   
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-3 mt-md-0">
                        <aside class="card card-custom card-right">
                            <h2>Checkout Informations</h2>
                            <table class="trip-informations">
                                <tr>
                                    <th width="50%">Members</th>
                                    <td width="50%" class="text-right">
                                        {{ $transaction->details->count() }} person
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Additional VISA</th>
                                    <td width="50%" class="text-right">
                                        $ {{ $transaction->additional_visa }},00
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Trip Price</th>
                                    <td width="50%" class="text-right">
                                        $ {{ $transaction->travel->price }},00 / person
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Sub Total</th>
                                    <td width="50%" class="text-right">
                                        $ {{ $transaction->transaction_total }},00
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Total (+Unique Code)</th>
                                    <td width="50%" class="text-right">
                                        <span class="text-blue">$ {{ $transaction->transaction_total }},</span>
                                        <span class="text-orange">{{ mt_rand(0,99) }}</span>
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <h2>Payment Instructions</h2>
                            <p class="payment-instructions">Please complete your payment before to 
                                <br />continue the wonderful trip</p>
                            <div class="bank">
                                {{-- <div class="bank-item pb-3 d-flex">
                                    <img src="{{ url('frontend/images/ic_bank.png') }}" alt="bank" width="45" height="45">
                                    <div class="description">
                                        <h3>PT Nomads ID</h3>
                                        <p>0881 8829 8800
                                            <br /> Bank Central Asia</p>
                                    </div>
                                </div>
                                <div class="bank-item pb-3 d-flex">
                                    <img src="{{ url('frontend/images/ic_bank.png') }}" alt="bank" width="45" height="45">
                                    <div class="description">
                                        <h3>PT Nomads ID</h3>
                                        <p>0899 8501 7888
                                            <br /> Bank HSBC</p>
                                    </div>
                                </div> --}}
                                <img src="{{ url('frontend/images/gopay-logo.png') }}" alt="Gopay Logo" class="w-50 mb-2">
                            </div>
                        </aside>
                        <div class="right-btn-container">
                            {{-- <a href="{{ route('checkout.sucess', $transaction->id) }}" class="btn btn-block btn-orange right-size">I Have Made Payment</a> --}}
                            <a href="{{ route('checkout.sucess', $transaction->id) }}" class="btn btn-block btn-orange right-size">Process Payment</a>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('detail', $transaction->travel->slug) }}" class="text-muted"><u>Cancel Booking</u></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End-Main -->
@endsection

@push('append-style')
    <!-- Gijgo -->
    <link rel="stylesheet" href='{{ url('frontend/libraries/gijgo/css/gijgo.min.css') }}'>
@endpush

@push('append-script')
    <!-- Gijgo -->
    <script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap4',
                icons: {
                    rightIcon: '<img src="{{ url('frontend/images/ic_doe.png') }}" />'
                }
            });
        });
    </script>
@endpush