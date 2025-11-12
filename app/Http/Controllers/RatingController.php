<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            'ratings' => Rating::all(),
        ]);
    }

    public function mealRating($mealId)
    {
        $averageRating = Rating::forMeal($mealId)->averageRating();
        return response()->json([
            'averageRating' => $averageRating,
        ]);
    }

    public function userRating($userId)
    {
        $averageRating = Rating::forUser($userId)->averageRating();
        return response()->json([
            'averageRating' => $averageRating,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Meal $meal)
    {
        // validate the ratings 
        $request->validate ([
            'rating' => 'required|integer|min:1|max:5',
        ]);
        // Store rating of meal from user
        $user = Auth::user();

        // update or create the ratings for the meal
        $rating = Rating::updateOrCreate(
            ['user_id' => $user->id, 'meal_id' => $meal->id],
            ['rating' => $request->rating]
        );
        $rating->save();
        return response()->json([
            'rating' => $rating,
        ]);

    }
    public function rateMeal(Request $request, Meal $meal)
    {
        // validate the ratings 
        $request->validate ([
            'rating' => 'required|integer|min:1|max:5',
        ]);
        // Store rating of meal from user
        $user = Auth::user();
        $existingRating = Rating::forUser($user->id)->forMeal($meal->id)->first();
        if ($existingRating) {
            $existingRating->update([
                'rating' => $request->rating,
            ]);
            return response()->json([
                'rating' => $existingRating,
            ]);
        }
        $rating = Rating::create([
            'user_id' => $user->id,
            'meal_id' => $meal->id,
            'rating' => $request->rating,
        ]);
        return response()->json([
            'rating' => $rating,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
