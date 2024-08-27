<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Book;
use Illuminate\Log\Logger;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BookController extends Controller
{
    public function userorder(Request $request){
        $book = new Book();
        $book->name = $request->name;
        $book->email = $request->email;
        $book->phone = $request->phone;
        $book->message = $request->message;
        $book->car_id = $request->car_id;
        $book->save();

        return redirect()->route('user.dashboard');
    }

    public function ssd(){
        $book=Book::with('car');
        return DataTables::of($book)
        ->filterColumn('car_id',function($query,$keyword){
            $query->whereHas('car',function($q1) use ($keyword){
                $q1->where('name','like','%'.$keyword.'%');
            });
        })
        ->addColumn('car_id',function($each){
            return $each->car->name;
        })
        ->addColumn('actions', function($each) {
            $statusButton = $each->status == '0'
                ? '<button class="btn btn-success status-btn"  data-car_id="' . $each->car_id . '"  data-id="' . $each->id . '" data-status="' . $each->status . '">Mark as Active</button>'
                : '<button disabled class="btn btn-warning status-btn" data-id="' . $each->id . '" data-status="' . $each->status . '">Actived</button>';

            return '<div class="d-flex justify-content-center">' . $statusButton . '</div>';
        })

        ->addColumn('created_at', function($each) {
            return $each->created_at->format('Y-m-d');
        })
        ->rawColumns(['actions'])
        ->make(true);
    }

    public function updateStatus(Request $request, $id)
    {
        $car=Car::findorFail($request->car_id);
        $car->status = "1";
        $car->save();

        $book = Book::findOrFail($id);
        $book->status = $request->status;
        $book->save();

        return response()->json(['success' => true]);
    }

    public function index(){
        return view('admin.book.index');
    }
}
