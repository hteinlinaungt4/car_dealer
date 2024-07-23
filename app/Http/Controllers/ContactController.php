<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $contact=Contact::find(1);
        return view('admin.contact.index',compact('contact'));
    }

    public function update(Request $request,$id){
       $contact = Contact::findorFail($id);
       $contact->address = $request->address;
       $contact->email = $request->email;
       $contact->phone = $request->phone;
       $contact->save();
       return redirect()
       ->route('admin.contact')
       ->with(['successmsg' => 'Contact Updated successfully!']);
    }
}
