@extends('admin.dashboard')
@section('title', 'Company Create')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Car Create Form</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-danger">{{$error}}</div>
                @endforeach
            @endif
            <form class="form-horizontal" method="post" action="{{ route('car.store') }}" enctype="multipart/form-data">
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
                                        <input class="form-control" id="cname" name="name" type="text"  />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Model</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmodel" name="model" type="text" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Image1</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image1" id="image1" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Image2</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image2" id="image2" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Image3</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image3" id="image3" >
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Type</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="ctype" name="type" type="text" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Body Color</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cbcolor" name="body_color" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Body Type</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cbodytype" name="body_type" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Company</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-bot15" name="company" id="ccompany">
                                            <option value="">Choose Company</option>
                                            @foreach ($company as $c)
                                                <option value="{{$c->id}}">{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Price</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cprice" name="price" type="text" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cnumber" name="number" type="text" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Length</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="clength" name="length" type="number" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Width</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cwidth" name="width" type="number" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Height</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cheight" name="height" type="number" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Seating Capacity</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cscapacity" name="seating_capacity" type="number" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Fuel Type</label>
                                    <div class="col-sm-10">
                                        <select name="fuel_type" class="form-control" >
                                            <option value="Fuel Type">Choose Type of Fuel</option>
                                            <option value="Gasoline">Gasoline</option>
                                            <option value="Diesel">Diesel</option>
                                            <option value="Liquid Petroleum">Petrol</option>
                                            <option value="Compressed Natural Gas">Compressed Natural Gas(CNG)</option>
                                            <option value="Ethanol">Ethanol</option>
                                            <option value="Biodiesel">Bio-Diesel</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Displacement</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cdisplacement" name="displacement" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Max Power</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmpower" name="max_power" type="text" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Max Torque</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmtorque" name="max_torque" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Mileage</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmilage" name="mileage" type="text" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Transmission Type</label>
                                    <div class="col-sm-10">
                                        <select name="transmission" class="form-control" >
                                            <option value="Transmission Type">Choose Transmission Type</option>
                                            <option value="Manual transmission">Manual Transmission</option>
                                            <option value="Automatic transmission">Automatic Transmission</option>
                                            <option value="Continuously variable transmission">Continuously Variable Transmission</option>
                                            <option value="Semi-automatic and dual-clutch transmissions">Semi-automatic and Dual-clutch Transmissions</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Second Column -->
                    <div class="col-lg-6">
                        <section class="panel">
                            <div class="panel-body">
                                <!-- Form fields for the second column -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">No. of Gears</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cnogear" name="no_of_gears" type="number" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Air Conditioning</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="air_conditioning" id="cair_conditioning">
                                            <option value="">Choose Air Conditioning</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Power Windows</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="power_windows" id="cpower_windows">
                                            <option value="">Choose Power Windows</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Central Locking</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="central_locking" id="central_locking">
                                            <option value="">Choose Central Locking</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ABS</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="abs" id="cabs">
                                            <option value="">Choose ABS</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Air Bags</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="air_bags" id="cair_bags">
                                            <option value="">Choose Air Bags</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Front Tire</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cftire" name="front_tire" type="text" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Rear Tire</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="crtire" name="rear_tire" type="text" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Fuel Capacity</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cfuelcapacity" name="fuel_capacity" type="number" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Boot Space</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cbootspace" name="boot_space" type="number" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Fog Lamps</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="fog_lamps" id="cfoglamps">
                                            <option value="">Choose Fog Lamps</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Engine Display</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cengine_display" name="engine_display" type="text" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Make Year</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmake_year" name="make_year" type="text" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Registration Year</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cregistration_year" name="registration_year" type="text" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">No. of Owners</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cno_of_owners" name="no_of_owners" type="number" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Insurance Type</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cinsurance_type" name="insurance_type" type="text" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">RTO</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="crto" name="rto" type="text" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">KM Driven</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="ckm_driven" name="km_driven" type="number" >
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
