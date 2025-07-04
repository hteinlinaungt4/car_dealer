<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Book;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Log\Logger;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\View\Components\Info;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function userorder(Request $request)
    {
        // Check if the user already booked the same car
        $existingBooking = Book::where('user_id', $request->user_id)
            ->where('car_id', $request->car_id)
            ->first();

        if ($existingBooking) {
            // Optionally return with error message or redirect back
            return redirect()->back()->with('error', 'You have already booked this car.');
        }

        // If no existing booking, proceed to save
        $book = new Book();
        $book->user_id = $request->user_id;
        $book->name = $request->name;
        $book->email = $request->email;
        $book->phone = $request->phone;
        $book->message = $request->message;
        $book->car_id = $request->car_id;
        $book->save();

        return redirect()->route('user.dashboard')->with('success', 'Booking successful!');
    }


    public function ssd()
    {
        $book = Book::with('car');
        return DataTables::of($book)
            ->filterColumn('car_id', function ($query, $keyword) {
                $query->whereHas('car', function ($q1) use ($keyword) {
                    $q1->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->addColumn('car_id', function ($each) {
                return $each->car->name;
            })
            // ->addColumn('actions', function($each) {
            //     $statusButton = $each->status == '0'
            //         ? '<button class="btn btn-success status-btn"  data-car_id="' . $each->car_id . '"  data-id="' . $each->id . '" data-status="' . $each->status . '">Mark as Active</button>'
            //         : '<button disabled class="btn btn-warning status-btn" data-id="' . $each->id . '" data-status="' . $each->status . '">Actived</button>';

            //     return '<div class="d-flex justify-content-center">' . $statusButton . '</div>';
            // })
            ->addColumn('actions', function ($each) {
                $selected0 = $each->status == 'pending' ? 'selected' : '';
                $selected1 = $each->status == 'confirmed' ? 'selected' : '';
                $selected2 = $each->status == 'rejected' ? 'selected' : '';
                $select = '
                <select class="form-select form-control status-select" data-car_id="' . $each->car_id . '" data-id="' . $each->id . '">
                    <option value="pending" ' . $selected0 . '>Pending</option>
                    <option value="confirmed" ' . $selected1 . '>Confirmed</option>
                    <option value="rejected" ' . $selected2 . '>Rejected</option>
                </select>
            ';
                return '<div class="d-flex justify-content-center">' . $select . '</div>';
            })

            ->addColumn('created_at', function ($each) {
                return $each->created_at->format('Y-m-d');
            })
            ->rawColumns(['actions'])
            ->make(true);
    }



    public function updateStatus(Request $request, $id)
    {
        // Update car availability status
        // $car = Car::findOrFail($request->car_id);
        // $car->status = $request->status == 'confirmed' ? '1' : '0';
        // $car->save();

        // Update booking status
        $book = Book::findOrFail($id);
        $book->status = $request->status;
        $book->driving_date = $request->testing_date;
        $book->save();

        // If confirmed, generate invoice
        // if ($request->status === 'confirmed') {
        //     // Avoid duplicate invoices if already exists
        //     $existingInvoice = Invoice::where('book_id', $book->id)->first();
        //     if (!$existingInvoice) {
        //         $user = User::findOrFail($book->user_id);
        //        $test= Invoice::create([
        //             'invoice_id' => 'INV-' . strtoupper(Str::random(6)),
        //             'book_id' => $book->id,
        //             'salesperson_name' => Auth::user()->name ?? 'Unknown',
        //             'buyer_name' => $user->name,
        //             'buyer_email' => $user->email,
        //             'total_amount' => $car->price,
        //             'confirmed_at' => now(),
        //         ]);
        //     }
        // }

        return response()->json(['success' => true]);
    }


    public function index()
    {
        return view('admin.book.index');
    }
}
