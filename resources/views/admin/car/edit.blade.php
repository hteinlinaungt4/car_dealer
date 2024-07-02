@extends('admin.dashboard')
@section('title', 'Car Edit')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Car Edit</h2>
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
                            <header class="panel-heading">
                                Add Car Detail
                            </header>
                            <div class="panel-body">
                                <!-- Form fields for the first column -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Name</label>
                                    <div class="col-sm-10">
                                        <input value="{{$car->name}}" class="form-control" id="cname" name="name" type="text" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Model</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmodel" value="{{$car->model}}" name="model" type="text">
                                    </div>
                                </div>
                                    <img class=" object-cover" src="{{asset('storage/cars/'.$car->image1)}}" width="150px" height="150px" alt="">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Image1</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image1" id="image1">
                                    </div>
                                </div>
                                <img class=" object-cover" src="{{asset('storage/cars/'.$car->image2)}}" width="150px" height="150px" alt="">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Image2</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image2" id="image2">
                                    </div>
                                </div>
                                <img class=" object-cover" src="{{asset('storage/cars/'.$car->image3)}}" width="150px" height="150px" alt="">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Image3</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image3" id="image3">
                                    </div>
                                </div>
                                <img class=" object-cover" src="{{asset('storage/cars/'.$car->image4)}}" width="150px" height="150px" alt="">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Image4</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image4" id="image4">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Type</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{$car->type}}" id="ctype" name="type" type="text" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Body Color</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{$car->body_color}}" id="cbcolor" name="body_color" type="text"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Body Type</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{$car->body_type}}" id="cbodytype" name="body_type" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Company</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-bot15" name="company" id="ccompany">
                                            <option value="">Choose Company</option>
                                            @foreach ($company as $c)
                                                <option @if($c->id == $car->company_id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Price</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cprice" value="{{$car->price}}" name="price" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cnumber" value="{{$car->number}}" name="number" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Length</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="clength" name="length" value="{{$car->length}}" type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Width</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cwidth" name="width" value="{{$car->width}}" type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Height</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cheight" name="height" value="{{$car->height}}" type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Seating Capacity</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cscapacity" value="{{$car->seating_capacity}}" name="seating_capacity"
                                            type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Fuel Type</label>
                                    <div class="col-sm-10">
                                        <select name="fuel_type" class="form-control">
                                            <option >Choose Type of Fuel</option>
                                            <option @if($car->fuel_type === "Gasoline") selected @endif value="Gasoline">Gasoline</option>
                                            <option @if($car->fuel_type === "Diesel") selected @endif value="Diesel">Diesel</option>
                                            <option @if($car->fuel_type === "Liquid Petroleum") selected @endif value="Liquid Petroleum">Petrol</option>
                                            <option @if($car->fuel_type === "Compressed Natural Gas") selected @endif value="Compressed Natural Gas">Compressed Natural Gas(CNG)</option>
                                            <option @if($car->fuel_type === "Ethanol") selected @endif value="Ethanol">Ethanol</option>
                                            <option @if($car->fuel_type === "Biodiesel") selected @endif value="Biodiesel">Bio-Diesel</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Displacement</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cdisplacement" value="{{$car->displacement}}" name="displacement"
                                            type="text" >
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
                                    <label class="col-sm-2 control-label">Max Power</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmpower" name="max_power" value="{{$car->max_power}}" type="text"
                                            >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Max Torque</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmtorque" value="{{$car->max_torque}}" name="max_torque" type="text"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Mileage</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmilage" value="{{$car->mileage}}" name="mileage" type="text"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Transmission Type</label>
                                    <div class="col-sm-10">
                                        <select name="transmission" class="form-control">
                                            <option>Choose Transmission Type</option>
                                            <option @if($car->transmission === "Manual transmission") selected @endif  value="Manual transmission">Manual Transmission</option>
                                            <option @if($car->transmission === "Automatic transmission") selected @endif value="Automatic transmission">Automatic Transmission</option>
                                            <option @if($car->transmission === "Continuously variable transmission") selected @endif value="Continuously variable transmission">Continuously Variable
                                                Transmission</option>
                                            <option @if($car->transmission === "Semi-automatic and dual-clutch transmissions") selected @endif value="Semi-automatic and dual-clutch transmissions">Semi-automatic and
                                                Dual-clutch Transmissions</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Form fields for the second column -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">No. of Gears</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cnogear" value="{{$car->no_of_gears}}" name="no_of_gears" type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Air Conditioning</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="air_conditioning" id="cair_conditioning">
                                            <option value="">Choose Air Conditioning</option>
                                            <option @if($car->air_conditioning === "true") selected @endif value="true">Yes</option>
                                            <option @if($car->air_conditioning === "false") selected @endif value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Power Windows</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="power_windows" id="cpower_windows">
                                            <option value="">Choose Power Windows</option>
                                            <option @if($car->power_windows === "true") selected @endif value="true">Yes</option>
                                            <option @if($car->power_windows === "false") selected @endif value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Central Locking</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="central_locking" id="central_locking">
                                            <option value="">Choose Central Locking</option>
                                            <option @if($car->central_locking === "true") selected @endif value="true">Yes</option>
                                            <option @if($car->central_locking === "false") selected @endif value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ABS</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="abs" id="cabs">
                                            <option value="">Choose ABS</option>
                                            <option @if($car->abs === "true") selected @endif  value="true">Yes</option>
                                            <option @if($car->abs === "false") selected @endif value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Air Bags</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="air_bags" id="cair_bags">
                                            <option value="">Choose Air Bags</option>
                                            <option @if($car->air_bags === "true") selected @endif value="true">Yes</option>
                                            <option @if($car->air_bags === "false") selected @endif value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Front Tire</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{$car->front_tire}}" id="cftire" name="front_tire" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Rear Tire</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="crtire" value="{{$car->rear_tire}}" name="rear_tire" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description">{{$car->description}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Fuel Capacity</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cfuelcapacity" name="fuel_capacity" value="{{$car->fuel_capacity}}"
                                            type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Boot Space</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cbootspace" value="{{$car->boot_space}}" name="boot_space" type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Fog Lamps</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="fog_lamps" id="cfoglamps">
                                            <option value="">Choose Fog Lamps</option>
                                            <option @if($car->fog_lamps === "true") selected @endif value="true">Yes</option>
                                            <option @if($car->fog_lamps === "false") selected @endif value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Engine Display</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cengine_display" name="engine_display"
                                            type="text" value="{{$car->engine_display}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Make Year</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmake_year" value="{{$car->make_year}}" name="make_year" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Registration Year</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" value="{{$car->registration_year}}" id="cregistration_year" name="registration_year"
                                            type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">No. of Owners</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cno_of_owners" value="{{$car->no_of_owners}}"  name="no_of_owners"
                                            type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Insurance Type</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cinsurance_type" name="insurance_type" value="{{$car->insurance_type}}"
                                            type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">RTO</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="crto" name="rto" type="text" value="{{$car->rto}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">KM Driven</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="ckm_driven" name="km_driven" value="{{$car->km_driven}}" type="number">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
