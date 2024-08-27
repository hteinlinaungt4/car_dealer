<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Company;
use Illuminate\Log\Logger;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.car.index');
    }

    public function ssd()
    {
        $car = Car::with('company');
        return DataTables::of($car)
            ->filterColumn('company', function ($query, $keyword) {
                $query->whereHas('company', function ($q1) use ($keyword) {
                    $q1->where('name', 'like', '%' . $keyword . '%');
                });
            })

            ->addColumn('company', function ($each) {
                return $each->company->name;
            })
            ->addColumn('actions', function ($each) {
                $edit = '<a href="' . route('car.edit', $each->id) . '" class="text-primary shadow p-2"><i class="fa-regular fa-pen-to-square p-1 fw-bold"></i></a>';
                $delete = '<a href="#" class=" delete_btn text-danger shadow  p-2" data-id="' . $each->id . '" ><i class="fa-solid fa-trash p-1 fw-bold"></i></a>';
                return '<div class="d-flex justify-content-center">' .
                    $edit . $delete
                    . '</div>';
            })
            ->editColumn('status', function ($each) {
                $stock = ($each->status == "0") ? '<span class="badge rounded-pill bg-success p-3 text-white">For Sell</span>' : '<span class="badge rounded-pill bg-danger p-3 text-white">Sold Out</span>';
                return $stock;
            })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower(trim($keyword));

                if (strpos($keyword, 'for sell') !== false || strpos($keyword, 'sell') !== false) {
                    $query->where('status', '0');
                } elseif (strpos($keyword, 'sold out') !== false || strpos($keyword, 'sold') !== false) {
                    $query->where('status', '1');
                }
            })


            ->rawColumns(['actions', 'image', 'status'])
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
            'image5' => 'required|mimes:jpg,jpeg,png|file',
            'type' => 'required|string|max:255',
            'body_color' => 'required|string|max:255',
            'price' => 'required|numeric',
            'company' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'position' => 'required',
            'fuel_type' => 'required|string|max:255',
            'mileage' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'max_power' => 'required|string|max:255',
            'description' => 'nullable|string',
            'no_of_owners' => 'required|integer',
        ];

        Validator::make($request->all(), $validation)->validate();

        $images = [];
        for ($i = 1; $i <= 5; $i++) {
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
        $car->image1 =  $images['image1'];
        $car->image2 =  $images['image2'];
        $car->image3 =  $images['image3'];
        $car->image4 =  $images['image4'];
        $car->image5 =  $images['image5'];
        $car->type = $request->input('type');
        $car->body_color = $request->input('body_color');
        $car->price = $request->input('price');
        $car->company_id = $request->input('company');
        $car->number = $request->input('number');
        $car->position = $request->input('position');
        $car->fuel_type = $request->input('fuel_type');
        $car->mileage = $request->input('mileage');
        $car->transmission = $request->input('transmission');
        $car->max_power = $request->input('max_power');
        $car->description = $request->input('description');
        $car->no_of_owners = $request->input('no_of_owners');
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
        $company = Company::all();
        $car = Car::findorFail($id);
        return view('admin.car.edit', compact('car', 'company'));
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
            'image1' => 'mimes:jpg,jpeg,png|file',
            'image2' => 'mimes:jpg,jpeg,png|file',
            'image3' => 'mimes:jpg,jpeg,png|file',
            'image4' => 'mimes:jpg,jpeg,png|file',
            'image5' => 'mimes:jpg,jpeg,png|file',
            'type' => 'required|string|max:255',
            'body_color' => 'required|string|max:255',
            'price' => 'required|numeric',
            'company' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'position' => 'required',
            'fuel_type' => 'required|string|max:255',
            'mileage' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'max_power' => 'required|string|max:255',
            'description' => 'nullable|string',
            'no_of_owners' => 'required|integer',
        ];

        Validator::make($request->all(), $validation)->validate();

        $images = [];
        for ($i = 1; $i <= 5; $i++) {
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
        $car->image1 =  $images['image1'];
        $car->image2 =  $images['image2'];
        $car->image3 =  $images['image3'];
        $car->image4 =  $images['image4'];
        $car->image5 =  $images['image5'];
        $car->type = $request->input('type');
        $car->body_color = $request->input('body_color');
        $car->price = $request->input('price');
        $car->company_id = $request->input('company');
        $car->number = $request->input('number');
        $car->position = $request->input('position');
        $car->fuel_type = $request->input('fuel_type');
        $car->mileage = $request->input('mileage');
        $car->transmission = $request->input('transmission');
        $car->max_power = $request->input('max_power');
        $car->description = $request->input('description');
        $car->no_of_owners = $request->input('no_of_owners');
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
        for ($i = 1; $i <= 5; $i++) {
            if ($car->{'image' . $i}) {
                Storage::delete('public/cars/' . $car->{'image' . $i});
            }
        }

        // Delete the vehicle record from the database
        $car->delete();

        $data = [
            'msg' => 'success',
        ];
        return response()->json($data, 200);
    }


    public function carlistdetail($id)
    {
        $user = Auth::user();
        $favCars = $user->cars->pluck('id')->toArray();
        $company = Company::where('id', $id)->first();
        $cars = Car::with('company')->where('company_id', $id)->where('status','0')->get();
        return view('user.detail', compact('cars', 'company', 'favCars'));
    }

    public function detail($id)
    {
        $car = Car::with('company')->findorFail($id);
        $car->view = $car->view + 1;
        $car->update();
        return view('user.cardetail', compact('car'));
    }


    public function mostinterest()
    {
        $cars = Car::with('company')
            ->where('view', '>', 0)  // Filter out records with 0 views
            ->orderBy('view')        // Order by the 'view' attribute
            ->take(10)               // Take the top 10 records
            ->get();
        $user = Auth::user();
        if ($user) {
            $favCars = $user->cars->pluck('id')->toArray();
            return view('user.most', compact('cars', 'favCars'));
        }
        return view('user.most', compact('cars'));
    }

    public function most()
    {
        return view('admin.Most Interest.index');
    }

    public function best()
    {
        return view('admin.Best Sell.index');
    }


    public function mostssd()
    {
        $car = Car::with('company')
            ->where('view', '>', 0)
            ->orderBy('view');
        return DataTables::of($car)
            ->filterColumn('company', function ($query, $keyword) {
                $query->whereHas('company', function ($q1) use ($keyword) {
                    $q1->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->addColumn('image', function ($each) {
                return '<img style="width:100px;height:100px;" class="object-cover" src="' . asset('storage/cars/' . $each->image1) . '" />';
            })
            ->addColumn('company', function ($each) {
                return $each->company->name;
            })
            ->rawColumns(['image'])
            ->make(true);
    }

    // public function bestssd() {
    //     $car = Car::with('company')
    //         ->where('status', '1');
    //     return DataTables::of($car)
    //         ->filterColumn('company', function($query, $keyword) {
    //             $query->whereHas('company', function($q1) use ($keyword) {
    //                 $q1->where('name', 'like', '%' . $keyword . '%');
    //             });
    //         })
    //         ->addColumn('image', function($each) {
    //             return '<img style="width:100px;height:100px;" class="object-cover" src="' . asset('storage/cars/' . $each->image1) . '" />';
    //         })
    //         ->addColumn('company', function($each) {
    //             return $each->company->name;
    //         })
    //         ->rawColumns(['image'])
    //         ->make(true);
    // }

    public function bestssd()
    {
        // Step 1: Group by car name and count the total number of sold-out cars for each name
        $bestSellingCars = Car::where('status', '1') // Only sold-out cars
            ->select('name', DB::raw('COUNT(*) as total_sales')) // Select name and count sold-out cars dynamically
            ->groupBy('name') // Group by name
            ->orderByRaw('COUNT(*) DESC') // Order by total sales dynamically
            ->get(); // Retrieve the results

        // Step 2: Map the data for DataTables
        $data = $bestSellingCars->map(function ($carGroup) {
            // Find the first car with this name to get the company name
            $car = Car::where('name', $carGroup->name)->first();

            return [
                'name' => $carGroup->name,
                'company' => $car->company->name ?? 'No Company', // Get the company name
                'total_sales' => $carGroup->total_sales, // Include the dynamically calculated total sales count
            ];
        });

        // Step 3: Return DataTables response
        return DataTables::of($data)
            ->make(true);
    }





    public function usercarlist()
    {
        $companies = Company::select('name', 'id')->get();
        $models = Car::select('name')->distinct()->pluck('name');
        $colors = Car::select('body_color')->distinct()->pluck('body_color');

        $cars = Car::where('status',"0")->get();
        $user = Auth::user();
        if ($user) {
            $favCars = $user->cars->pluck('id')->toArray();
            return view('user.car', compact('cars', 'favCars', 'companies', 'models', 'colors'));
        }
        return view('user.car', compact('cars', 'companies', 'models', 'colors'));
    }

    public function search(Request $request)
    {
        $query = $request->key;

        $car = Car::where('name', 'LIKE', "%{$query}%")
            ->where('status',"0")
            ->orWhere('model', 'LIKE', "%{$query}%")
            ->orWhere('type', 'LIKE', "%{$query}%")
            ->orWhere('body_color', 'LIKE', "%{$query}%")
            ->orWhere('price', 'LIKE', "%{$query}%")
            ->orWhere('max_power', 'LIKE', "%{$query}%")
            ->orWhere('mileage', 'LIKE', "%{$query}%")
            ->orWhere('position', 'LIKE', "%{$query}%")
            ->orWhere('transmission', 'LIKE', "%{$query}%")
            ->get();
        return response()->json($car);
    }

    public function carsearch(Request $request)
    {
        // $query = Car::query();
        $query = Car::where('status',"0");


        if ($request->filled('brand')) {
            $query->where('company_id', 'like', '%' . $request->brand . '%');
        }

        if ($request->filled('model')) {
            $query->where('name', 'like', '%' . $request->model . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('color')) {
            $query->where('body_color', 'like', '%' . $request->color . '%');
        }

        $cars = $query->get();

        $data = [
            'msg' => 'success',
            'cars' => $cars,
        ];

        $user = Auth::user();
        if ($user) {
            $favCars = $user->cars->pluck('id')->toArray();
            $data['favCars'] = $favCars;  // Add favCars to the existing data array
        }

        return response()->json($data, 200);
    }

    public function bestsellcar($name){
        $user = Auth::user();
        $cars = Car::where('name', $name)->where('status','0')->get();
        $companyNames = $cars->pluck('company.name')->toArray();
        if ($user) {
            $favCars = $user->cars->pluck('id')->toArray();
            return view('user.bestsell', compact('cars','favCars','companyNames'));
        }
        return view('user.bestsell', compact('cars','companyNames'));
    }
}
