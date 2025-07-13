<?php
namespace App\Http\Controllers\Admin;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class AdminInquiryController extends Controller
{
    // List all inquiries
    public function index()
    {
        $inquiries = Inquiry::with(['car', 'user'])->latest()->get();
        return view('admin.inquery.index', compact('inquiries'));
    }

    // Show single inquiry and reply form
    public function show($id)
    {
        $inquiry = Inquiry::with(['car', 'user'])->findOrFail($id);
        return view('admin.inquiries.show', compact('inquiry'));
    }

    // Store admin reply
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->reply = $request->reply;
        $inquiry->save();

        // Optionally: notify user here
      return response()->json(['message' => 'Reply sent successfully'], 200);

    }


     public function ssd(){
        $inquiries=Inquiry::with(['car','user']);
        return DataTables::of($inquiries)
    ->editColumn('message', function($inquiry){
    return '<div style="max-width: auto; max-height: 100px; overflow: auto; white-space: pre-wrap;">'
           . e($inquiry->message) . '</div>';
})
->editColumn('reply', function($inquiry){
    return '<div style="max-width: 400px; max-height: 100px; overflow: auto; white-space: pre-wrap;">'
           . e($inquiry->reply) . '</div>';
})

        ->editColumn('car_id', function($inquiry){
            return $inquiry->car ? $inquiry->car->name : 'N/A';
        })
        ->editColumn('user_id', function($inquiry){
            return $inquiry->user ? $inquiry->user->name : 'N/A';
        })
      ->addColumn('action', function($inquiry){
            $url = route('admin.inquiries.reply', ['id' => $inquiry->id]);
return '<a href="#" data-url="' . $url . '" class="btn btn-primary btn-sm reply">Reply</a>';
        })

        ->rawColumns(['action','message','reply'])

        ->make(true);
    }
}
