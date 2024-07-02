@extends('user.master.layouts')
@section('title', 'Car Dealer')
@section('content')

    <div class="banner header-text">
        <div class="owl-banner owl-carousel">
            <div class="banner-item-01">
                <div class="text-content">
                    <h4>Find your car today!</h4>
                    <h2>Preowned Car Selling Portal</h2>
                </div>
            </div>
            <div class="banner-item-02">
                <div class="text-content">
                    <h4>Find the Right car in your budget</h4>
                    <h2>Preowned Car Selling Portal</h2>
                </div>
            </div>
            <div class="banner-item-03">
                <div class="text-content">
                    <h4>FIND THE RIGHT CAR</h4>
                    <h2>Preowned Car Selling Portal</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="services section-background">
        <div class="container">
            <div class="row">
                @foreach ($company as $c)
                    <div class="col-md-3">
                        <div class="service-item">
                            <div class="icon">
                                <img src="{{ asset('storage/company/' . $c->image) }}" width="200" height="100">
                            </div>
                            <a href="{{route('carlist',$c->id)}}">
                                <div class="down-content">
                                    <h4>{{ $c->name }}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>


        </div>
    </div>

@endsection
