@extends('user.master.layouts')
@section('title', 'Best Sell Model')
@section('content')


    <div class="page-heading about-heading header-text"
        style="background-image: url({{ asset('user/assets/images/heading-6-1920x500.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        @if ($companyNames)
                            <h4>{{$companyNames[0]}}</h4>
                        @endif
                        <h2>Cars</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="mt-5">
                <i class="fa fa-home"></i> <a href="{{ route('user.dashboard') }}">Home</a> > <a
                    onclick="window.history.back()">Best Sell Model</a>
            </div>
        </div>
    </div>

    @if (count($cars) != 0)
        <div class="products">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
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
                                            <h4>{{ $c->name }} {{ $c->model }}</h4>
                                            <h6> {{ $c->price }} MMK</h6>


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
    </script>
@endsection
