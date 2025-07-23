<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use DateTime; // Import DateTime class
use Illuminate\Support\Facades\Mail; // Import Mail facade
use App\Mail\ReservationConfirmation; // Import the Mailable

class ReservationController extends Controller
{
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
                    $date = new DateTime($value);
                    $dayOfWeek = $date->format('N'); // 1 (Mon) - 7 (Sun)
                    if ($dayOfWeek >= 6) { // 6=Sat, 7=Sun
                        $fail('Reservations are not available on weekends');
                    }
                }
            ],
            'time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $time = strtotime($value);
                    $start = strtotime('07:00');
                    $end = strtotime('19:00');
                    if ($time < $start || $time > $end) {
                        $fail('Reservations must be between 7:00 AM and 7:00 PM');
                    }
                }
            ],
            'guests' => 'required|integer|min:1|max:20',
            'special_requests' => 'nullable|string'
        ]);

        // Create reservation
        $reservation = Reservation::create($validated);

        // Send email notification
        // Mail::to($reservation->email)
        //     ->cc(config('mail.restaurant_email'))
        //     ->send(new ReservationConfirmation($reservation));

        return response()->json([
            'message' => 'Reservation created successfully',
            'reservation' => $reservation
        ], 201);
    }
}