<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Reservations/Index');
    }

    public function getReservation(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->get('per_page', 10);

        $query = Reservation::orderBy('id', 'desc');

        if ($user->role !== 'admin') {
            $query->where('email', $user->email);
        }

        return response()->json(['reservations' => $query->paginate($perPage)]);
    }

    public function show(Reservation $reservation)
    {
        return Inertia::render('Reservation/Show', ['reservation' => $reservation]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    // 6 = Saturday, 7 = Sunday
                    if ((int) date('N', strtotime($value)) >= 6) {
                        $fail('Reservations are not available on weekends.');
                    }
                },
            ],
            'time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $time = strtotime($value);
                    if ($time < strtotime('07:00') || $time > strtotime('19:00')) {
                        $fail('Reservations must be between 7:00 AM and 7:00 PM.');
                    }
                },
            ],
            'guests' => 'required|integer|min:1|max:20',
            'special_requests' => 'nullable|string',
        ]);

        $reservation = Reservation::create($validated);

        return response()->json([
            'message' => 'Reservation created successfully',
            'reservation' => $reservation,
        ], 201);
    }

    public function edit(Reservation $reservation)
    {
        return inertia('Reservations/Edit', ['reservation' => $reservation]);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'guests' => 'required|integer|min:1|max:20',
            'special_requests' => 'nullable|string|max:500',
        ]);

        $reservation->update($validated);

        return response()->json(['reservation' => $reservation]);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted']);
    }
}
