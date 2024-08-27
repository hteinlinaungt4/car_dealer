<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\About;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Log\Logger;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index()
    {
        $company = Company::all();


        $cars = Car::with('company')
            ->where('view', '>', 0)  // Filter out records with 0 views
            ->orderBy('view')        // Order by the 'view' attribute
            ->take(3)               // Take the top 10 records
            ->get();

        $bestsellmodel = Car::where('status', '1') // Only sold-out cars
            ->select('name') // Select name and count sold-out cars dynamically
            ->groupBy('name') // Group by name
            ->orderByRaw('COUNT(*) DESC') // Order by total sales dynamically
            ->take(12)
            ->get(); // Retrieve the results
        return view('user.dashboard', compact('company', 'cars', 'bestsellmodel'));
    }

    public function myprofile()
    {
        return view('user.myprofile');
    }

    public function fav()
    {
        $user = Auth::user();
        $fav = $user->cars->where('status', 0);
        return view('user.fav', compact('fav'));
    }

    public function userlist()
    {
        return view('admin.userlist.index');
    }

    public function ssd()
    {
        $user = User::where('role', 'user');
        return DataTables::of($user)
            ->addColumn('actions', function ($each) {
                return '<button class="btn btn-danger delete_btn" data-id="' . $each->id . '" >Delete</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function delete(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $data = [
            'msg' => 'success',
        ];
        return response()->json($data, 200);
    }

    public function favremove($id)
    {
        $user = Auth::user();
        $car = Car::findOrFail($id);
        if ($user->cars()->where('car_id', $id)->exists()) {
            $user->cars()->detach($id);
            $data = [
                'msg' => 'success',
            ];
            return response()->json($data, 200);
        }
        $data = [
            'msg' => 'Fail',
        ];
        return response()->json($data, 400);
    }

    public function addfav($id)
    {
        $car = Car::findorFail($id);
        $user = Auth::user();

        if (!$user->cars()->where('car_id', $car->id)->exists()) {
            $user->cars()->attach($car);
        }

        $data = [
            'msg' => 'Success',
        ];
        return response()->json($data, 200);
    }

    public function about()
    {
        $about = About::find(1);
        return view('user.aboutus', compact('about'));
    }

    public function contact()
    {
        $contact = Contact::find(1);
        return view('user.contact', compact('contact'));
    }

    function changepasswordpage()
    {
        return view('user.changepassword');
    }
    // ChangePassword
    function changepassword(Request $request)
    {
        $this->ValidationCheck($request);
        $id = Auth::user()->id;
        $oldpassword = User::select('password')->where('id', $id)->first();
        $oldpassword = $oldpassword->password;
        if (Hash::check($request->oldpassword, $oldpassword)) {
            $data = [
                'password' => Hash::make($request->newpassword),
            ];
            User::where('id', $id)->update($data);
            Auth::guard('web')->logout();
            return redirect()->route('user.dashboard');
        } else {
            return back()->with(['doesnot' => 'You are oldpassword does not match!']);
        }
    }

    private function getData($request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        return $data;
    }

    private function ValidationCheck($request)
    {
        $validation = [
            'oldpassword' => 'required|min:6|max:10',
            'newpassword' => 'required|min:6|max:10',
            'comfirmpassword' => 'required|min:6|max:10|same:newpassword',
        ];
        Validator::make($request->all(), $validation)->validate();
    }
}
