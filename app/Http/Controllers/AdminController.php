<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function adminlist(){
        return view('admin.adminlist.index');
    }


    public function ssd(){
        $user=User::where('role','admin');
        return DataTables::of($user)
        ->addColumn('actions', function($each) {
            return '<button class="btn btn-success role-btn" data-id="' . $each->id . '" >Change to User</button>';
        })
        ->rawColumns(['actions'])
        ->make(true);
    }

    public function admintouser(Request $request,$userId){

        $user = User::findOrFail($userId);

        // Update the user's role based on the role data sent via AJAX request
        $user->role = $request->role; // Assuming the role data is sent in the request

        // Save the updated user
        $user->save();

        // Return a success response
        return response()->json(['message' => 'User role changed successfully']);
    }



    public function index(){
        $user = User::all()->count();
        $book = Book::all()->count();
        $brand = Company::all()->count();
        $vehicle = Car::all()->count();
        $sellcars = Car::where('status','0')->get()->count();
        $soldcars = Car::where('status','1')->get()->count();
        return view('admin.total',compact('user','book','brand','vehicle','sellcars','soldcars'));
    }



    function changepasswordpage(){
        return view('admin.updatepassword.updatepassword');
    }
    // ChangePassword
    function changepassword(Request $request){
        $this->ValidationCheck($request);
        $id=Auth::user()->id;
        $oldpassword=User::select('password')->where('id',$id)->first();
        $oldpassword=$oldpassword->password;
        if(Hash::check($request->oldpassword,$oldpassword)){
            $data=[
                'password' => Hash::make( $request->newpassword),
            ];
            User::where('id',$id)->update($data);
            Auth::guard('web')->logout();
            return redirect()->route('user.dashboard');
        }else{
           return back()->with(['doesnot' => 'You are oldpassword does not match!']);
        }
    }

    public function overallcount(){
        $user = User::all()->count();
        $book = Book::all()->count();
        $brand = Company::all()->count();
        $vehicle = Car::all()->count();
        $soldcars = Car::where('status','1')->get()->count();
        $sellcars = Car::where('status','0')->get()->count();
        return view('admin.total',compact('user','book','brand','vehicle','sellcars','soldcars'));
    }



    private function ValidationCheck($request){
        $validation=[
            'oldpassword' => 'required|min:6|max:10',
            'newpassword'=> 'required|min:6|max:10',
            'comfirmpassword' => 'required|min:6|max:10|same:newpassword'
        ];
        Validator::make($request->all(),$validation)->validate();
    }
}
