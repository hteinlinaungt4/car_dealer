@extends('user.master.layouts')
@section('title', 'About Us')
@section('content')
    <!-- Page Content -->
    <div class="page-heading about-heading header-text" style="background-image: url({{asset('user/assets/images/heading-1-1920x500.jpg')}});">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>about us</h4>
              <h2>our company</h2>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="best-features about-features">
      <div class="container">
        <div class="row">

          <div class="col-md-12">
            <div class="right-image">
              <img src="{{asset('user/assets/images/about-1-570x350.jpg')}}" alt="">
            </div>
          </div>

        </div>
      </div>
    </div>


    <div class="team-members">
      <div class="container">
        <div class="row">
          <div class="col-md-12">

              <h3 class="my-3">About Us</h3>
              <p>Welcome to Customer! We are passionate about helping you find the perfect vehicle to suit your needs and budget. Since our establishment in 2001, we have been dedicated to providing exceptional customer service and a wide range of high-quality vehicles. Whether you’re looking for a new, certified pre-owned, or used car, our knowledgeable team is here to assist you every step of the way.

                Dear, we believe in transparency, integrity, and customer satisfaction. Our extensive inventory features the latest models from top manufacturers as well as reliable pre-owned vehicles that have undergone rigorous inspections to ensure quality and safety. We strive to make your car-buying experience as seamless and enjoyable as possible.

                Visit us today to explore our selection and discover why so many customers trust [Your Dealership Name] for their automotive needs. Your satisfaction is our top priority.</p>
          </div>
        </div>
      </div>
    </div>


@endsection
