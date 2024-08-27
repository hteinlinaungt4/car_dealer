@extends('user.master.layouts')
@section('title', 'Car Detail Lists')
@section('content')
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
                <i class="fa fa-home"></i> <a href="{{route('user.dashboard')}}">Home</a> > <a onclick="window.history.back()">Carlist</a> > Detail
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
                                <img src="{{asset('storage/cars/'.$car->image3)}}" alt="" class="img-fluid">
                            </div>
                            <br>
                        </div>
                        <div class="col-sm-6 col-6">
                            <div>
                                <img src="{{asset('storage/cars/'.$car->image3)}}" alt="" class="img-fluid">
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
                                    <span class="pull-left">Car Model</span>

                                    <strong class="pull-right">{{$car->name}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Car Company</span>

                                    <strong class="pull-right">{{$car->company->name}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Year</span>

                                    <strong class="pull-right">{{$car->model}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Car Type</span>

                                    <strong class="pull-right">{{$car->type}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">No of owner</span>

                                    <strong class="pull-right">{{$car->no_of_owners}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Car Body Color</span>

                                    <strong class="pull-right">{{$car->body_color}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Steering Position</span>

                                    <strong class="pull-right">{{$car->position}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Engine Power</span>

                                    <strong class="pull-right">{{$car->max_power}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Car Number</span>

                                    <strong class="pull-right">{{$car->number}}</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Car Price</span>

                                    <strong class="pull-right">{{$car->price}} (Lakh)</strong>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Car Fuel Type</span>

                                    <strong class="pull-right">{{$car->fuel_type}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Kilometers</span>

                                    <strong class="pull-right">{{$car->mileage}}</strong>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="clearfix">
                                    <span class="pull-left">Description</span>

                                    <strong class="pull-right">{{$car->description}}</strong>
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
                <h2>Contact Details</h2>
            </div>
            <div class="row">
                <div class="col-md-6">


                    <div class="left-content">
                        <p>
                            <span>Address</span>

                            <br>

                            <strong>Taunggyi</strong>
                        </p>

                        <p>
                            <span>Phone</span>

                            <br>

                            <strong>
                                <a href="tel:123-456-789">09448977540</a>
                            </strong>
                        </p>



                        <p>
                            <span>Email</span>

                            <br>

                            <strong>
                                <a href="mailto:john@carsales.com">example.com</a>
                            </strong>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Make
                        Book</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
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
                    <form method="post" action="{{route('user.order')}}">
                        @csrf
                        <input type="hidden" name="car_id" value="{{$car->id}}">
                        <div class="form-group">
                            <input class="form-control" value="{{Auth::user()->name}}" type="text" name="name" required="true"
                                placeholder="Name" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" required="true"
                                placeholder="Email" value="{{Auth::user()->email}}" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="number" name="phone" maxlength="10" pattern="[0-9]+"
                                placeholder="Mobile Number" value="{{Auth::user()->phone}}" required="true" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Message" required="true" rows="4"></textarea>
                        </div>
                        <button class="btn btn-red btn-lg w-100" type="submit">Submit</button>
                    </form>
                </div>
                <!--   <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div> -->
            </div>

        </div>
    </div>

    </div>
@endsection
