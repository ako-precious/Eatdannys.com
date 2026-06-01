<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index()
    {
        return response()->json(['ratings' => Rating::all()]);
    }

    public function mealRating(int $mealId)
    {
        return response()->json([
            'averageRating' => Rating::forMeal($mealId)->averageRating(),
        ]);
    }

    public function userRating(int $userId)
    {
        return response()->json([
            'averageRating' => Rating::forUser($userId)->averageRating(),
        ]);
    }

    // Called via POST /ratings (resource route)
    public function store(Request $request, Meal $meal)
    {
        $request->validate(['rating' => 'required|integer|min:1|max:5']);

        $rating = Rating::updateOrCreate(
            ['user_id' => Auth::id(), 'meal_id' => $meal->id],
            ['rating' => $request->rating]
        );

        return response()->json(['rating' => $rating]);
    }

    // Called via POST /meals/{meal}/rate
    public function rateMeal(Request $request, Meal $meal)
    {
        $request->validate(['rating' => 'required|integer|min:1|max:5']);

        $user = Auth::user();
        $existing = Rating::forUser($user->id)->forMeal($meal->id)->first();

        if ($existing) {
            $existing->update(['rating' => $request->rating]);
            return response()->json(['rating' => $existing]);
        }

        $rating = Rating::create([
            'user_id' => $user->id,
            'meal_id' => $meal->id,
            'rating' => $request->rating,
        ]);

        return response()->json(['rating' => $rating]);
    }
}
