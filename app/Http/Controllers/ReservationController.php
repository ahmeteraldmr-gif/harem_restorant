<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:100',
            'phone'  => 'required|string|max:20',
            'email'  => 'nullable|email|max:100',
            'date'   => 'required|date|after_or_equal:today',
            'time'   => 'required',
            'guests' => 'required|integer|min:1|max:30',
            'notes'  => 'nullable|string|max:500',
        ]);

        Reservation::create($validated);

        return redirect()->route('rezervasyon')->with('success', 'Rezervasyonunuz alındı! En kısa sürede sizi arayacağız.');
    }
}
