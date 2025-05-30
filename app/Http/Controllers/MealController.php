<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
public function getMeals(Request $request)
{

    $perPage = $request->get('per_page', 10); // Default pagination
    $search = $request->input('search');

    $query = Meal::with(['category'])->orderBy('id', 'desc');

    // Apply search filter
    if ($search) {
        $query->where('name', 'like', "%{$search}%")
              ->orWhereHas('category', fn($q) =>
                  $q->where('name', 'like', "%{$search}%")
              );
    }

    // Return paginated meals
    $meals = $query->paginate($perPage);

    return response()->json([
        'meals' => $meals,
    ]);
}

 public function index(Request $request)
    {
    
        return  Inertia::render('Meal/Index');
    }
    
}
