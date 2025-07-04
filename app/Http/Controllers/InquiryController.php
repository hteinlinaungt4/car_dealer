<?php
namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    // Show inquiry form for a car
    public function create($car_id)
    {
        $car = Car::with('features')->findOrFail($car_id);
        return view('inquiries.create', compact('car'));
    }

    // Store inquiry
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'message' => 'required|string',
        ]);

        Inquiry::create([
            'user_id' => Auth::id(),
            'car_id' => $request->car_id,
            'message' => $request->message,
        ]);

        return redirect()->route('user.dashboard');
    }

    // User's inquiry list
    public function index()
    {
        $inquiries = Inquiry::with('car')->where('user_id', Auth::id())->latest()->get();
        return view('user.inquery', compact('inquiries'));
    }
}
