@extends('admin.dashboard')
@section('title', 'Car Edit')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ __('messages.admin_car_edit') }}</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-danger">{{$error}}</div>
                @endforeach
            @endif
            <form class="form-horizontal" method="post" action="{{ route('car.update',$car->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <!-- First Column -->
                    <div class="col-lg-6">
                        <section class="panel">

                            <div class="panel-body">
                                <!-- Form fields for the first column -->
                                <div class="form-group">
                                    <label class=" control-label">{{__('messages.admin_car_model')}}</label>
                                    <div class="col-sm-10">
                                        <input value="{{$car->name}}" class="form-control" id="cname" name="name" type="text"  />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" control-label">{{__('messages.admin_car_year')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{$car->model}}" id="cmodel" name="model" type="text" >
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <img src="{{asset('storage/cars/'.$car->image1 )}}" style="width:100px;height:100px" alt="">
                                </div>
                                <div class="form-group">
                                    <label class=" control-label">{{__('messages.admin_car_image1')}}</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image1" id="image1" >
                                    </div>
                                </div>

                                <div class="ml-3">
                                    <img src="{{asset('storage/cars/'.$car->image2 )}}" style="width:100px;height:100px" alt="">
                                </div>
                                <div class="form-group">
                                    <label class=" control-label">{{__('messages.admin_car_image2')}}</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image2" id="image2" >
                                    </div>
                                </div>

                                <div class="ml-3">
                                    <img src="{{asset('storage/cars/'.$car->image3 )}}" style="width:100px;height:100px" alt="">
                                </div>
                                <div class="form-group">
                                    <label class=" control-label">{{__('messages.admin_car_image3')}}</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image3" id="image3" >
                                    </div>
                                </div>

                                <div class="ml-3">
                                    <img src="{{asset('storage/cars/'.$car->image4 )}}" style="width:100px;height:100px" alt="">
                                </div>
                                <div class="form-group">
                                    <label class=" control-label">{{__('messages.admin_car_image4')}}</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image4" id="image4" >
                                    </div>
                                </div>

                                <div class="ml-3">
                                    <img src="{{asset('storage/cars/'.$car->image5 )}}" style="width:100px;height:100px" alt="">
                                </div>
                                <div class="form-group">
                                    <label class=" control-label">{{__('messages.admin_car_image5')}}</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image5" id="image5" >
                                    </div>
                                </div>


                            </div>
                        </section>
                    </div>

                    <!-- Second Column -->
                    <div class="col-lg-6">
                        <section class="panel">
                            <div class="panel-body">


                                <div class="form-group">
                                    <label class=" control-label">{{__('messages.admin_car_type')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{$car->type}}" id="ctype" name="type" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" control-label">{{__('messages.admin_body_color')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{$car->body_color}}" id="cbcolor" name="body_color" type="text" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class=" control-label">{{__('messages.admin_price')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value={{$car->price}} id="cprice" name="price" type="number" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" control-label">{{ __('messages.admin_company')}}</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-bot15" name="company" id="ccompany">
                                            <option value="">Choose Company</option>
                                            @foreach ($company as $c)
                                                <option value="{{$c->id}}" @if($car->company_id == $c->id) selected @endif>{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class=" control-label">{{ __('messages.admin_number')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{$car->number}}" id="cnumber" name="number" type="text" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" control-label">{{__('messages.admin_steering_position')}}</label>
                                    <div class="col-sm-10">
                                        <select name="position" class="form-control" >
                                            <option>Choose Transmission Type</option>
                                            <option value="right" @if($car->position == "right") selected @endif>Right</option>
                                            <option value="left" @if($car->position == "left") selected @endif>Left</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class=" control-label">{{ __('messages.admin_fuel_type')}}</label>
                                    <div class="col-sm-10">
                                        <select name="fuel_type" class="form-control" >
                                            <option>Choose Type of Fuel</option>
                                            <option value="Diesel" @if($car->fuel_type == "Diesel") selected @endif>Diesel</option>
                                            <option value="Petrol" @if($car->fuel_type == "Petrol") selected @endif>Petrol</option>
                                            <option value="Hybrid" @if($car->fuel_type == "Hybrid") selected @endif>Hybrid</option>
                                            <option value="Ev" @if($car->fuel_type == "Ev") selected @endif>EV</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class=" control-label">{{ __('messages.admin_kilometer')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{$car->mileage}}" id="cmilage" name="mileage" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" control-label">{{ __('messages.admin_transmission')}}</label>
                                    <div class="col-sm-10">
                                        <select name="transmission" class="form-control" >
                                            <option >Choose Transmission Type</option>
                                            <option value="Manual" @if($car->transmission == "Manual") selected @endif>Manual</option>
                                            <option value="Auto" @if($car->transmission == "Auto") selected @endif>Auto</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" control-label">{{ __('messages.admin_engine_power')}}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{$car->max_power}}" id="cmpower" name="max_power" type="text" required>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class=" control-label">{{__('messages.admin_description')}}</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description">{{$car->description}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">{{__('messages.admin_update')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
