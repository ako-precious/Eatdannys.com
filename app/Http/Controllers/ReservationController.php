<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|integer|min:1|max:20',
            'special_requests' => 'nullable|string'
        ]);

        $reservation = Reservation::create($validated);

        return response()->json([
            'message' => 'Reservation created successfully',
            'reservation' => $reservation
        ], 201);
    }
}
