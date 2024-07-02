<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.car.index');
    }

    public function ssd(){
        $car=Car::with('company');
        return DataTables::of($car)
        ->filterColumn('company',function($query,$keyword){
            $query->whereHas('company',function($q1) use ($keyword){
                $q1->where('name','like','%'.$keyword.'%');
            });
        })
        ->addColumn('company', function($each) {
            return $each->company->name;
        })
        ->addColumn('actions',function($each){
            $edit = '<a href="'.route('car.edit',$each->id).'" class="text-primary shadow p-2"><i class="fa-regular fa-pen-to-square p-1 fw-bold"></i></a>';
            $delete='<a href="#" class=" delete_btn text-danger shadow  p-2" data-id="'.$each->id.'" ><i class="fa-solid fa-trash p-1 fw-bold"></i></a>';
            return '<div class="d-flex justify-content-center">'.
                    $edit.$delete
                    .'</div>';
        })
        ->rawColumns(['actions','image'])
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = Company::all();
        return view('admin.car.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = [
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'image1' => 'required|mimes:jpg,jpeg,png|file',
            'image2' => 'required|mimes:jpg,jpeg,png|file',
            'image3' => 'required|mimes:jpg,jpeg,png|file',
            'image4' => 'required|mimes:jpg,jpeg,png|file',
            'type' => 'required|string|max:255',
            'body_color' => 'required|string|max:255',
            'body_type' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'price' => 'required|numeric',
            'number' => 'required|string|max:255',
            'length' => 'required|integer',
            'width' => 'required|integer',
            'height' => 'required|integer',
            'seating_capacity' => 'required|integer',
            'fuel_type' => 'required|string|max:255',
            'displacement' => 'required|string|max:255',
            'max_power' => 'required|string|max:255',
            'max_torque' => 'required|string|max:255',
            'mileage' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'no_of_gears' => 'required|integer',
            'air_conditioning' => 'required',
            'power_windows' => 'required',
            'central_locking' => 'required',
            'abs' => 'required',
            'air_bags' => 'required',
            'front_tire' => 'required|string|max:255',
            'rear_tire' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fuel_capacity' => 'required|integer',
            'boot_space' => 'required|integer',
            'fog_lamps' => 'required',
            'engine_display' => 'required|string|max:255',
            'make_year' => 'required|integer',
            'registration_year' => 'required|integer',
            'no_of_owners' => 'required|integer',
            'insurance_type' => 'required|string|max:255',
            'rto' => 'required|string|max:255',
            'km_driven' => 'required|integer',
        ];

        Validator::make($request->all(), $validation)->validate();

        $images = [];
        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile('image' . $i)) {
                $file = $request->file('image' . $i);
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/cars', $filename);
                $images['image' . $i] = $filename;
            }
        }

        $car = new Car();
        $car->name = $request->input('name');
        $car->model = $request->input('model');
        $car->image1 = $images['image1'];
        $car->image2 = $images['image2'];
        $car->image3 = $images['image3'];
        $car->image4 = $images['image4'];
        $car->type = $request->input('type');
        $car->body_color = $request->input('body_color');
        $car->body_type = $request->input('body_type');
        $car->company_id = $request->input('company');
        $car->price = $request->input('price');
        $car->number = $request->input('number');
        $car->length = $request->input('length');
        $car->width = $request->input('width');
        $car->height = $request->input('height');
        $car->seating_capacity = $request->input('seating_capacity');
        $car->fuel_type = $request->input('fuel_type');
        $car->displacement = $request->input('displacement');
        $car->max_power = $request->input('max_power');
        $car->max_torque = $request->input('max_torque');
        $car->mileage = $request->input('mileage');
        $car->transmission = $request->input('transmission');
        $car->no_of_gears = $request->input('no_of_gears');
        $car->air_conditioning = $request->input('air_conditioning');
        $car->power_windows = $request->input('power_windows');
        $car->central_locking = $request->input('central_locking');
        $car->abs = $request->input('abs');
        $car->air_bags = $request->input('air_bags');
        $car->front_tire = $request->input('front_tire');
        $car->rear_tire = $request->input('rear_tire');
        $car->description = $request->input('description');
        $car->fuel_capacity = $request->input('fuel_capacity');
        $car->boot_space = $request->input('boot_space');
        $car->fog_lamps = $request->input('fog_lamps');
        $car->engine_display = $request->input('engine_display');
        $car->make_year = $request->input('make_year');
        $car->registration_year = $request->input('registration_year');
        $car->no_of_owners = $request->input('no_of_owners');
        $car->insurance_type = $request->input('insurance_type');
        $car->rto = $request->input('rto');
        $car->km_driven = $request->input('km_driven');
        $car->save();

        return redirect()
            ->route('car.index')
            ->with(['successmsg' => 'Car created successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company=Company::all();
        $car=Car::findorFail($id);
        return view('admin.car.edit',compact('car','company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $car = Car::findOrFail($id);

        $validation = [
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'image1' => 'nullable|mimes:jpg,jpeg,png|file',
            'image2' => 'nullable|mimes:jpg,jpeg,png|file',
            'image3' => 'nullable|mimes:jpg,jpeg,png|file',
            'image4' => 'nullable|mimes:jpg,jpeg,png|file',
            'type' => 'required|string|max:255',
            'body_color' => 'required|string|max:255',
            'body_type' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'price' => 'required|numeric',
            'number' => 'required|string|max:255',
            'length' => 'required|integer',
            'width' => 'required|integer',
            'height' => 'required|integer',
            'seating_capacity' => 'required|integer',
            'fuel_type' => 'required|string|max:255',
            'displacement' => 'required|string|max:255',
            'max_power' => 'required|string|max:255',
            'max_torque' => 'required|string|max:255',
            'mileage' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'no_of_gears' => 'required|integer',
            'air_conditioning' => 'required',
            'power_windows' => 'required',
            'central_locking' => 'required',
            'abs' => 'required',
            'air_bags' => 'required',
            'front_tire' => 'required|string|max:255',
            'rear_tire' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fuel_capacity' => 'required|integer',
            'boot_space' => 'required|integer',
            'fog_lamps' => 'required',
            'engine_display' => 'required|string|max:255',
            'make_year' => 'required|integer',
            'registration_year' => 'required|integer',
            'no_of_owners' => 'required|integer',
            'insurance_type' => 'required|string|max:255',
            'rto' => 'required|string|max:255',
            'km_driven' => 'required|integer',
        ];

        Validator::make($request->all(), $validation)->validate();

        $images = [];
        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile('image' . $i)) {
                // Delete the old image if a new one is uploaded
                if ($car->{'image' . $i}) {
                    Storage::delete('public/cars/' . $car->{'image' . $i});
                }

                $file = $request->file('image' . $i);
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/cars', $filename);
                $images['image' . $i] = $filename;
            } else {
                $images['image' . $i] = $car->{'image' . $i};  // Preserve the existing image if no new image is uploaded
            }
        }

        $car->name = $request->input('name');
        $car->model = $request->input('model');
        $car->image1 = $images['image1'];
        $car->image2 = $images['image2'];
        $car->image3 = $images['image3'];
        $car->image4 = $images['image4'];
        $car->type = $request->input('type');
        $car->body_color = $request->input('body_color');
        $car->body_type = $request->input('body_type');
        $car->company_id = $request->input('company');
        $car->price = $request->input('price');
        $car->number = $request->input('number');
        $car->length = $request->input('length');
        $car->width = $request->input('width');
        $car->height = $request->input('height');
        $car->seating_capacity = $request->input('seating_capacity');
        $car->fuel_type = $request->input('fuel_type');
        $car->displacement = $request->input('displacement');
        $car->max_power = $request->input('max_power');
        $car->max_torque = $request->input('max_torque');
        $car->mileage = $request->input('mileage');
        $car->transmission = $request->input('transmission');
        $car->no_of_gears = $request->input('no_of_gears');
        $car->air_conditioning = $request->input('air_conditioning');
        $car->power_windows = $request->input('power_windows');
        $car->central_locking = $request->input('central_locking');
        $car->abs = $request->input('abs');
        $car->air_bags = $request->input('air_bags');
        $car->front_tire = $request->input('front_tire');
        $car->rear_tire = $request->input('rear_tire');
        $car->description = $request->input('description');
        $car->fuel_capacity = $request->input('fuel_capacity');
        $car->boot_space = $request->input('boot_space');
        $car->fog_lamps = $request->input('fog_lamps');
        $car->engine_display = $request->input('engine_display');
        $car->make_year = $request->input('make_year');
        $car->registration_year = $request->input('registration_year');
        $car->no_of_owners = $request->input('no_of_owners');
        $car->insurance_type = $request->input('insurance_type');
        $car->rto = $request->input('rto');
        $car->km_driven = $request->input('km_driven');
        $car->save();

        return redirect()
            ->route('car.index')
            ->with(['successmsg' => 'Car created successfully!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);

        // Delete the associated image files
        for ($i = 1; $i <= 4; $i++) {
            if ($car->{'image' . $i}) {
                Storage::delete('public/cars/' . $car->{'image' . $i});
            }
        }

        // Delete the vehicle record from the database
        $car->delete();

        $data=[
            'msg' => 'success',
        ];
        return response()->json($data, 200);
    }


    public function carlistdetail($id)
    {
        $company=Company::where('id',$id)->first();
        $cars=Car::with('company')->where('company_id',$id)->get();
        return view('user.detail',compact('cars','company'));
    }



}
