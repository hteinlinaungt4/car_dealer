@extends('user.master.layouts')
@section('title', 'Car Detail Lists')
@section('content')
<style>
      .admin-note {
        background-color: #eaf6ff; /* Light blue for note */
        border-left: 4px solid #007bff;
        padding: 20px;
        border-radius: 4px;
        margin-top: 40px;
        font-style: italic;
        color: #0056b3;
    }

</style>
    <div class="page-heading about-heading header-text" style="background-image: url({{asset('user/assets/images/heading-6-1920x500.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4> <strong class="text-primary"> {{$car->price}} (Lakh) </strong></h4>
                        <h2>{{$car->name}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="mt-5">
                <i class="fa fa-home"></i> <a href="{{route('user.dashboard')}}">{{ __('messages.home') }}</a> > <a onclick="window.history.back()">{{ __('messages.carlist') }}</a> > {{ __('messages.detail') }}
            </div>
        </div>
    </div>

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <img src="{{asset('storage/cars/'.$car->image1)}}" class="img-fluid wc-image object-cover w-100">
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 col-6">
                            <div>
                                <img src="{{asset('storage/cars/'.$car->image2)}}" alt="" class="img-fluid">
                            </div>
                            <br>
                        </div>
                        <div class="col-sm-6 col-6">
                            <div>
                                <img src="{{asset('storage/cars/'.$car->image3)}}" alt="" class="img-fluid">
                            </div>
                            <br>
                        </div>
                        <div class="col-sm-6 col-6">
                            <div>
                                <img src="{{asset('storage/cars/'.$car->image4)}}" alt="" class="img-fluid">
                            </div>
                            <br>
                        </div>
                        <div class="col-sm-6 col-6">
                            <div>
                                <img src="{{asset('storage/cars/'.$car->image5)}}" alt="" class="img-fluid">
                            </div>
                            <br>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <form action="#" method="post" class="form">
                        <ul class="list-group list-group-flush">


                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">{{ __('messages.car_model') }}</span>

                                    <strong class="pull-right">{{$car->name}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">{{ __('messages.car_company') }}</span>

                                    <strong class="pull-right">{{$car->company->name}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">{{ __('messages.year') }}</span>

                                    <strong class="pull-right">{{$car->model}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">{{ __('messages.car_type') }}</span>

                                    <strong class="pull-right">{{$car->type}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">{{ __('messages.car_body_color') }}</span>

                                    <strong class="pull-right">{{$car->body_color}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">{{ __('messages.steering_position') }}</span>

                                    <strong class="pull-right">{{$car->position}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">{{ __('messages.engine_power') }}</span>

                                    <strong class="pull-right">{{$car->max_power}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">{{ __('messages.car_number') }}</span>

                                    <strong class="pull-right">{{$car->number}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">{{ __('messages.car_price') }}</span>

                                    <strong class="pull-right">{{$car->price}} (Lakh)</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">{{ __('messages.car_fuel_type') }}</span>

                                    <strong class="pull-right">{{$car->fuel_type}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">{{ __('messages.kilometer') }}</span>

                                    <strong class="pull-right">{{$car->mileage}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">{{ __('messages.description') }}</span>

                                    <strong class="pull-right">{{$car->description}}</strong>
                                </div>
                            </li>
                            <li class="list-group-time">
                                <div class="clearfix">
                                     <div class="admin-note">
                                            <p><strong>{{__('messages.insurance')}}</strong></p>
                                            {{-- Replace with dynamic data: <p><strong>Note from Admin:</strong> {{ $invoice->admin_reply }}</p> --}}
                                        </div>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <div class="section">
        <div class="container">
            <div class="section-heading">
                <h2>{{ __('messages.contact_details') }}</h2>
            </div>
            <div class="row">
                <div class="col-md-6">


                    <div class="left-content">
                        <p>
                            <span>{{ __('messages.address') }}</span>

                            <br>

                            <strong>Taunggyi</strong>
                        </p>

                        <p>
                            <span>{{ __('messages.phone') }}</span>

                            <br>

                            <strong>
                                <a href="tel:123-456-789">09448977540</a>
                            </strong>
                        </p>



                        <p>
                            <span>{{  __('messages.email')}}</span>

                            <br>

                            <strong>
                                <a href="mailto:john@carsales.com">example.com</a>
                            </strong>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    @if (Auth::check())
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">{{ __('messages.make_book')}}</button>
                        <br><br>
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#Modal">{{ __('messages.inquiry')}}</button>

                    @else
                        <!-- Redirect to Login Page if Not Authenticated -->
                        <a href="{{ route('login') }}" class="btn btn-info btn-lg">{{ __('messages.make_book')}}</a>
                        <a href="{{ route('login') }}" class="btn btn-info btn-lg">{{ __('messages.inquiry')}}</a>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->

    @if (Auth::check())
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Book</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('user.order') }}">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <div class="form-group">
                                <input class="form-control" value="{{ Auth::user()->name }}" type="text" name="name" required placeholder="Name" />
                                <input class="form-control" value="{{ Auth::user()->id }}" type="hidden" name="user_id" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" required placeholder="Email" value="{{ Auth::user()->email }}" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="number" name="phone" maxlength="10" pattern="[0-9]+" placeholder="Mobile Number" value="{{ Auth::user()->phone }}" required />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="Message" required rows="4"></textarea>
                            </div>
                            <button class="btn btn-red btn-lg w-100" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inquiry Modal -->
        <div class="modal fade" id="Modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Inquiry Form</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('inquiries.store') }}">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <div class="form-group">
                                <input class="form-control" value="{{ Auth::user()->name }}" type="text" name="name" required placeholder="Name" />
                                <input class="form-control" value="{{ Auth::user()->id }}" type="hidden" name="user_id" />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="Message" required rows="4"></textarea>
                            </div>
                            <button class="btn btn-red btn-lg w-100" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif


    </div>
@endsection

@section('script')
<script>
     @if(session('error'))
        Swal.fire({
            icon: 'warning',
            title: 'Already Booked',
            text: 'You have already booked this car.',
        });
    @endif

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Booking Successful!',
            text: 'Your booking has been confirmed.',
        });
    @endif
</script>
@endsection
