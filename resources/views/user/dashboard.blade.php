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
        </div>
    </div>
    <div class="services section-background">
        <div class="container mb-5">
            <div class="mr-right d-flex">
                <input id="search" type="text" class="form-control w-25 border-end-0"
                    placeholder="Search Car Brand...">
            </div>
        </div>
        <div class="container mb-3">
            <h3 class="mb-3">Car Brands</h3>
            <div class="row" id="result">
                    @foreach ($company as $c)
                        <div class="col-md-3">
                            <div class="service-item">
                                <div class="icon">
                                    <img src="{{ asset('storage/company/' . $c->image) }}" width="180" height="100">
                                </div>
                                <a href="{{ route('carlist', $c->id) }}">
                                    <div class="down-content">
                                        <h4>{{ $c->name }}</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

            </div>
        </div>

        @if(count($cars) != 0)
        <div class="container">
            <h3 class="mt-5">Most Interest Cars</h3>
            <div class="products">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($cars as $c)
                                    <div class="col-md-4">
                                        <div class="product-item">
                                            <img src="{{asset('storage/cars/'.$c->image1)}}" height="250" class=" object-cover">
                                            <div class="down-content">
                                                    <h4>{{$c->name}} {{$c->model}}</h4>

                                                <h6> {{$c->price}} MMK</h6>


                                                <small>
                                                    <strong title="Author"><i class="fa fa-code-fork" aria-hidden="true"></i>
                                                        {{$c->transmission}}</strong>
                                                    &nbsp;&nbsp;
                                                    <strong title="Author"><i class="fa fa-street-view" aria-hidden="true"></i>
                                                        {{$c->position}}</strong>&nbsp;&nbsp;
                                                    <strong title="Views"><i class="fa fa-fire" aria-hidden="true"></i>{{$c->fuel_type}}</strong>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="float-right mb-3">
                                <a href="{{route('car.interest')}}" class="btn btn-danger btn-sm" >See More Interest Car</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <h3 style="color: red;" class="text-center my-5">Today, we do not have the most interest list</h3>
        @endif


        <div class="container">
            <h3 class="my-5">Most Best Sell Model</h3>
            <div class="row mx-auto">
                @foreach ($bestsellmodel as $b)
                    <div class="col-md-4 py-3">
                      <a href="{{route('car.bestsellcar',$b->name)}}">{{$b['name']}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $('#search').on('keyup', function(event) {
            if (event.key === 'Enter') {
                searchCarBrand();
            }
        });

        function searchCarBrand() {
            const key = $('#search').val();
            $.ajax({
                url: '/search',
                type: 'GET',
                data: {
                    key
                },
                success: function(data) {
                    $('#result').empty();

                    $.each(data, function(index, company) {
                        $('#result').append(`
                        <div class="col-md-3">
                            <div class="service-item">
                                <div class="icon">
                                    <img src="/storage/company/${company.image}" width="200" height="100">
                                </div>
                                <a href="/carlist/${company.id}">
                                    <div class="down-content">
                                        <h4>${company.name}</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    `);
                    });
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>

@endsection
