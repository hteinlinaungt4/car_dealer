@extends('user.master.layouts')
@section('title', 'About Us')
@section('content')
    <!-- Page Content -->
    <div class="page-heading about-heading header-text" style="background-image: url({{asset('user/assets/images/heading-1-1920x500.jpg')}});">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>{{ __('messages.about_us')}}</h4>
              <h2>{{ __('messages.our_company')}}</h2>
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

              <h3 class="my-3">{{ __('messages.about_us')}}</h3>
              <p>{{$about->description}}</p>
          </div>
        </div>
      </div>
    </div>


@endsection

