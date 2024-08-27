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

                            <div class="panel-body">
                                <!-- Form fields for the first column -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Model</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cname" name="name" type="text" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Year</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmodel" name="model" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Image1</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image1" id="image1" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Image2</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image2" id="image2" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Image3</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image3" id="image3" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Image4</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image4" id="image4" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Image5</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image5" id="image5" required>
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
                                    <label class="col-sm-2 control-label">Car Price</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cprice" name="price" type="number" required>
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
                                    <label class="col-sm-2 control-label">Car Company</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-bot15" name="company" id="ccompany" required>
                                            <option value="">Choose Company</option>
                                            @foreach ($company as $c)
                                                <option value="{{$c->id}}">{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cnumber" name="number" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Steering Position</label>
                                    <div class="col-sm-10">
                                        <select name="position" class="form-control" required>
                                            <option>Choose Transmission Type</option>
                                            <option value="right">Right</option>
                                            <option value="left">Left</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Fuel Type</label>
                                    <div class="col-sm-10">
                                        <select name="fuel_type" class="form-control" required>
                                            <option>Choose Type of Fuel</option>
                                            <option value="Diesel">Diesel</option>
                                            <option value="Petrol">Petrol</option>
                                            <option value="Hybrid">Hybrid</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">KM</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmilage" name="mileage" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Transmission Type</label>
                                    <div class="col-sm-10">
                                        <select name="transmission" class="form-control" required>
                                            <option >Choose Transmission Type</option>
                                            <option value="Manual">Manual</option>
                                            <option value="Auto">Auto</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Max Power</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cmpower" name="max_power" type="text" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Car Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">No. of Owners</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="cno_of_owners" name="no_of_owners" type="number" required>
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
