@extends('user.master.layouts')
@section('title', 'Car Lists')
@section('content')


    <div class="page-heading mb-5 about-heading header-text"
        style="background-image: url({{ asset('user/assets/images/heading-6-1920x500.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        {{-- <h4>All</h4> --}}
                        <h2>{{ __('messages.cars') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-between align-items-center">
        <div class="">
            <input id="search" type="text" class="form-control  border-end-0" placeholder="{{ __('messages.search_car') }}">
        </div>
        <div>
          {{ __('messages.total')}} {{count($cars)}}
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="d-flex flex-column h-100">
                    <div class="form-group mb-3 flex-grow-1">
                        <label for="brand">{{ __('messages.brand') }}:</label>
                        <select name="brand" id="brand" class="form-control">
                            <option value="">{{ __('messages.select_brand') }}</option>
                            @foreach ($companies as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="d-flex flex-column h-100">
                    <div class="form-group mb-3 flex-grow-1">
                        <label for="model">{{ __('messages.model') }}:</label>
                        <select name="model" id="model" class="form-control">
                            <option value="">{{ __('messages.select_model') }}</option>
                            @foreach ($models as $model)
                                <option value="{{ $model }}">{{ $model }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="d-flex flex-column h-100">
                    <div class="form-group mb-3 flex-grow-1">
                        <label for="color">{{ __('messages.color') }}:</label>
                        <select name="color" id="color" class="form-control">
                            <option value="">{{ __('messages.select_color') }}</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color }}">{{ $color }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="d-flex flex-column h-100">
                    <div class="form-group mb-3 flex-grow-1">
                        <label for="min_price">{{ __('messages.min_price') }}:</label>
                        <input type="number" name="min_price" id="min_price" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="d-flex flex-column h-100">
                    <div class="form-group mb-3 flex-grow-1">
                        <label for="max_price">{{ __('messages.max_price') }}:</label>
                        <input type="number" name="max_price" id="max_price" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary w-100 " id="searchcar">{{ __('messages.search') }}</button>
    </div>




    @if (count($cars) != 0)
        <div class="products">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row" id="result">

                            @foreach ($cars as $c)
                                <div class="col-md-4">
                                    <div class="product-item">
                                        <a href="{{ route('car.detail', $c->id) }}"><img
                                                src="{{ asset('storage/cars/' . $c->image1) }}" height="250"
                                                class=" object-cover"></a>
                                        <div class="down-content">
                                            @if (Auth::check())
                                                <div>
                                                    @if (in_array($c->id, $favCars))
                                                        <a href="#" class="float-right">
                                                            <i class="fa fa-star red-star" aria-hidden="true"></i>
                                                        </a>
                                                    @else
                                                        <a href="#" class="float-right add-fav-btn"
                                                            data-id="{{ $c->id }}">
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                            <a href="">
                                                <h4> {{ $c->name }} {{ $c->model }}</h4>
                                            </a>

                                            <h6> {{ $c->price }} (Lakh)</h6>


                                            <small>
                                                <strong title="Author"><i class="fa fa-code-fork" aria-hidden="true"></i>
                                                    {{ $c->transmission }}</strong>
                                                &nbsp;&nbsp;
                                                <strong title="Author"><i class="fa fa-street-view" aria-hidden="true"></i>
                                                    {{ $c->position }}</strong>&nbsp;&nbsp;
                                                <strong title="Views"><i class="fa fa-fire"
                                                        aria-hidden="true"></i>{{ $c->fuel_type }}</strong>
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

@section('script')
    <script>
        $('#search').on('keyup', function(event) {
            if (event.key === 'Enter') {
                searchCar();
            }
        });
        $(document).on('click', '.add-fav-btn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var button = $(this);
            $.ajax({
                    method: "GET",
                    url: `/addfav/${id}`,
                })
                .done(function(msg) {
                    button.replaceWith(
                        '<a class="float-right"><i class="fa fa-star red-star" aria-hidden="true"></i></a>'
                    ); // Replace with full star icon
                });
        });

        function searchCar() {
            const key = $('#search').val();
            $.ajax({
                url: '/findcar',
                type: 'GET',
                data: {
                    key
                },
                success: function(data) {
                    $('#result').empty();
                    $.each(data, function(index, car) {
                        $('#result').append(`
                        <div class="col-md-4">
                            <div class="product-item">
                                <a href="cardetail/${car.id}"><img src="/storage/cars/${car.image1}" height="250" class="object-cover"></a>
                                <div class="down-content">
                                    <a href="">
                                        <h4> ${car.name} ${car.model}</h4>
                                    </a>
                                    <h6>${car.price} (Lakh)</h6>
                                    <small>
                                        <strong title="Author"><i class="fa fa-code-fork" aria-hidden="true"></i> ${car.transmission}</strong>
                                        &nbsp;&nbsp;
                                        <strong title="Author"><i class="fa fa-street-view" aria-hidden="true"></i> ${car.position}</strong>
                                        &nbsp;&nbsp;
                                        <strong title="Views"><i class="fa fa-fire" aria-hidden="true"></i> ${car.fuel_type}</strong>
                                    </small>
                                </div>
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

        $('#searchcar').on('click', function() {
            var brand = $('#brand').val();
            var model = $('#model').val();
            var color = $('#color').val();
            var min_price = $('#min_price').val();
            var max_price = $('#max_price').val();

            $('#car-results').html('<p>Loading...</p>');

            $.ajax({
                url: "/carsearch",
                type: 'GET',
                data: {
                    brand: brand,
                    model: model,
                    color: color,
                    min_price: min_price,
                    max_price: max_price,
                },
                success: function(response) {
                    $('#result').empty();

                    // Check if favCars is provided (only for authenticated users)
                    let favCars = response.favCars ? response.favCars : [];

                    // Check if there are any cars
                    if (response.cars.length > 0) {
                        response.cars.forEach(function(car) {
                            let favIcon = '';

                            // Only add the favorite icon logic if favCars is available
                            if (favCars.length > 0) {
                                let isFavorite = favCars.includes(car.id);
                                favIcon = isFavorite ?
                                    '<a href="#" class="float-right"><i class="fa fa-star red-star" aria-hidden="true"></i></a>' :
                                    '<a href="#" class="float-right add-fav-btn" data-id="' +
                                    car.id +
                                    '"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
                            }

                            let carItem = `
                                    <div class="col-md-4">
                                        <div class="product-item">
                                            <a href="cardetail/${car.id}"><img src="/storage/cars/${car.image1}" height="250" class="object-cover"></a>
                                            <div class="down-content">
                                                ${favIcon}
                                                <a href="#">
                                                    <h4> ${car.name} ${car.model}</h4>
                                                </a>
                                                <h6>${car.price} (Lakh)</h6>
                                                <small>
                                                    <strong title="Transmission"><i class="fa fa-code-fork" aria-hidden="true"></i> ${car.transmission}</strong>
                                                    &nbsp;&nbsp;
                                                    <strong title="Position"><i class="fa fa-street-view" aria-hidden="true"></i> ${car.position}</strong>
                                                    &nbsp;&nbsp;
                                                    <strong title="Fuel Type"><i class="fa fa-fire" aria-hidden="true"></i> ${car.fuel_type}</strong>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                `;

                            // Append car item to the result div
                            $('#result').append(carItem);
                        });
                    } else {
                        // If no cars are found, show a message
                        $('#result').html(
                            '<h3 style="color: red;" class="text-center my-5">No Car Lists</h3>');
                    }
                }
            });
        });
    </script>

@endsection
