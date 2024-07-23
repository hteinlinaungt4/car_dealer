@extends('user.master.layouts')
@section('title', 'Contact Us')
@section('content')
    <!-- Header -->

    <!-- Page Content -->
    <div class="page-heading contact-heading header-text"
        style="background-image: url({{ asset('user/assets/images/heading-4-1920x500.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="find-us">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Our Office Address</h2>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="left-content">
                        <h4>Address</h4>
                        <p>{{$contact->address}}</p>
                        <h4>Email</h4>
                        <p>{{$contact->email}}</p>
                        <h4>Phone Number</h4>
                        <p>{{$contact->phone}}</p>
                        <p>you can contact us on the above details
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>








@endsection
