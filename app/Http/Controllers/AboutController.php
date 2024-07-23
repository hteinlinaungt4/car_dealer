<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function index(){
        $about=About::find(1);
        return view('admin.About.index',compact('about'));
    }

    public function update(Request $request,$id){
       $about = About::findorFail($id);
       $about->description = $request->description;
       $about->save();
       return redirect()
       ->route('admin.about')
       ->with(['successmsg' => 'About Updated successfully!']);
    }
}
