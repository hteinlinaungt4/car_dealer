<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Book;
use App\Models\User;
use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Console\View\Components\Info;

class AdminController extends Controller
{
    public function adminlist()
    {
        return view('admin.adminlist.index');
    }


    public function ssd()
    {
        $user = User::where('role', 'admin');
        return DataTables::of($user)
            ->addColumn('actions', function ($each) {
                return '<button class="btn btn-success role-btn" data-id="' . $each->id . '" >Change to User</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function admintouser(Request $request, $userId)
    {

        $user = User::findOrFail($userId);

        // Update the user's role based on the role data sent via AJAX request
        $user->role = $request->role; // Assuming the role data is sent in the request

        // Save the updated user
        $user->save();

        // Return a success response
        return response()->json(['message' => 'User role changed successfully']);
    }



    public function index()
    {
        $user = User::all()->count();
        $book = Book::all()->count();
        $brand = Company::all()->count();
        $vehicle = Car::all()->count();
        $sellcars = Car::where('status', ['0'])->get()->count();
        $soldcars = Car::where('status', '1')->get()->count();
        return view('admin.total', compact('user', 'book', 'brand', 'vehicle', 'sellcars', 'soldcars'));
    }



    function changepasswordpage()
    {
        return view('admin.updatepassword.updatepassword');
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

    public function overallcount()
    {
        $user = User::all()->count();
        $book = Book::all()->count();
        $brand = Company::all()->count();
        $vehicle = Car::all()->count();
        $sellcars = Car::where('status', ['0'])->get()->count();
        $soldcars = Car::where('status', '1')->get()->count();
        return view('admin.total', compact('user', 'book', 'brand', 'vehicle', 'sellcars', 'soldcars'));
    }



    private function ValidationCheck($request)
    {
        $validation = [
            'oldpassword' => 'required|min:6|max:10',
            'newpassword' => 'required|min:6|max:10',
            'comfirmpassword' => 'required|min:6|max:10|same:newpassword'
        ];
        Validator::make($request->all(), $validation)->validate();
    }

    public function invoice()
    {
        return view('admin.invoice.index');
    }

    public function ssdInvoices()
    {
        $invoice = Invoice::query();
        return DataTables::of($invoice)
            ->make(true);
    }


    public function process()
    {
        return view('admin.process.index');
    }

    public function ssdProcess()
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
            ->addColumn('amount', function ($each) {
                return $each->car->price;
            })

           ->addColumn('actions', function ($each) {
                    $buttonClass = '';
                    $buttonText = '';
                    $disabled = '';

                    if ($each->invoices == '0') {
                        $buttonClass = 'btn-success confirm-booking-btn';
                        $buttonText = 'Confirm Payment';
                    } else {
                        $buttonClass = 'btn-secondary';
                        $buttonText = 'Payment Confirmed';
                        $disabled = 'disabled';
                    }

                    return '
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-sm ' . $buttonClass . '"
                                data-id="' . $each->id . '"
                                data-car_id="' . $each->car_id . '"
                                ' . $disabled . '>
                                ' . $buttonText . '
                            </button>
                        </div>
                    ';
                })


            ->addColumn('created_at', function ($each) {
                return $each->created_at->format('Y-m-d');
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function confirm(Request $request)
    {



        $book = Book::with('car')->findOrFail($request->book_id);
        $book->invoices = '1';
        $book->update();


         $car = Car::findOrFail($book->car->id);
        $car->status = $car->status == '0' ? '1' : '0';
        $car->save();

        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Booking not found']);
        }
        // Avoid duplicate invoices if already exists
        $existingInvoice = Invoice::where('book_id', $request->book_id)->first();
        if (!$existingInvoice) {


            $user = User::findOrFail($book->user_id);
            $test = Invoice::create([
                'invoice_id' => 'INV-' . strtoupper(Str::random(6)),
                'book_id' => $book->id,
                'salesperson_name' => Auth::user()->name ?? 'Unknown',
                'buyer_name' => $user->name,
                'buyer_email' => $user->email,
                'total_amount' => $book->car->price,
                'confirmed_at' => now(),
            ]);
        }
        return response()->json(['success' => true]);
    }
}
