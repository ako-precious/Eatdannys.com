<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
public function getMeal(Request $request)
{
    
    $perPage = $request->get('per_page', 10);
    $search = $request->input('search');

    $query = Meal::with(['user', 'prices', 'category'])->orderBy("id", "desc");

  
   

    // Apply search filter if provided
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhereHas('category', function ($catQuery) use ($search) {
                  $catQuery->where('name', 'like', "%{$search}%");
              });
        });
    }

    return response()->json([
        'meals' => $query->paginate($perPage),
    ]);
}


 public function index(Request $request)
    {
    
        return  Inertia::render('Meal/Index');
    }
    
}
