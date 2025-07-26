<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use DateTime; // Import DateTime class
use Illuminate\Support\Facades\Mail; // Import Mail facade
use App\Mail\ReservationConfirmation; // Import the Mailable
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function index(Request $request)
    {
         return  Inertia::render('Reservations/Index');
    }

     public function getReservation(Request $request)
    {
//get the user token to continue

        $user = Auth::user();
        $perPage = $request->get('per_page', 10); // default 10

        $query = Reservation::orderBy("id", "desc");

        // If the user is not an admin, only show their orders
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        $reservations = $query->paginate($perPage);
       
        return response()->json([
            'reservations' => $reservations,
        ]);
    }

     public function show(Reservation $reservation)
    {      
           $reservation->with('user');
        return  Inertia::render('Reservation/Show',[
            'reservation' => $reservation,
        ]);
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

     public function edit(Reservation $Reservation)
    {
        return inertia('Reservations/Edit', [
            'reservation' => $Reservation,
        ]);
    }

     public function update(Request $request, Reservation $reservation)
{
    $validated = $request->validate([ 
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255|email',
        'phone' => 'required|string|max:255',
        'date' => 'required|string|max:25',
        'time' => 'required|string|max:25',
        'guests' => 'required|integer' ,
        'special_requests' => 'nullable|string|max:225',
    ]);
    

     $reservation->update($validated);

  
    
  return response()->json([
          
            '$reservation' => $reservation,
             
        ]);

    // return back()->with('success', 'reser$reservation updated successfully.');
}

public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(['message' => 'reservation deleted']);
    }
    
}