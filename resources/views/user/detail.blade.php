@extends('user.master.layouts')
@section('title', 'Car Lists')
@section('content')


    <div class="page-heading about-heading header-text"
        style="background-image: url({{ asset('user/assets/images/heading-6-1920x500.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>{{$company->name}}</h4>
                        <h2>Cars</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(count($cars) != 0)
    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">

                        @foreach ($cars as $c)
                            <div class="col-md-4">
                                <div class="product-item">
                                    <a href=""><img src="{{asset('storage/cars/'.$c->image1)}}" height="250"></a>
                                    <div class="down-content">
                                        <a href="">
                                            <h4>{{$c->name}}</h4>
                                        </a>

                                        <h6> ${{$c->price}}</h6>

                                        <p>{{$c->max_power}} &nbsp;/&nbsp; {{$c->fuel_type}} &nbsp;/&nbsp; {{$c->registration_year}} &nbsp;/&nbsp; Used vehicle
                                        </p>

                                        <small>
                                            <strong title="Author"><i class="fa fa-dashboard"></i> {{$c->km_driven}}km.</strong>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <strong title="Author"><i class="fa fa-cube"></i>
                                                {{$c->displacement}}</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <strong title="Views"><i class="fa fa-cog"></i> {{$c->transmission}}</strong>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <h3 style="color: red;" class="text-center my-5">No Car Lists</h3>
    @endif

@endsection
