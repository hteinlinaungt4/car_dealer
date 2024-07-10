<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
      //
      public function index(){
        $company = Company::all();
        return view('user.dashboard',compact('company'));
    }



    public function myprofile(){
        return view('user.myprofile',);
    }



    public function userlist(){
        return view('admin.userlist.index');
    }


    public function ssd(){
        $user=User::where('role','user');
        return DataTables::of($user)
        ->addColumn('actions', function($each) {
            return '<button class="btn btn-danger delete_btn" data-id="' . $each->id . '" >Delete</button>';
        })
        ->rawColumns(['actions'])
        ->make(true);
    }

    public function delete(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $data=[
            'msg' => 'success',
        ];
        return response()->json($data, 200);
    }





    public function about(){
        return view('user.aboutus');
    }

    public function contact(){
        return view('user.contact');
    }


    function changepasswordpage(){
        return view('user.changepassword');
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



    private function getData($request){
        $data=[
            'name' => $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'address'=> $request->address,
        ];
        return $data;

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
