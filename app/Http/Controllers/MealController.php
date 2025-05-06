<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index(Request $request)
{
    $query = Meal::with('category');

    if ($search = $request->input('search')) {
        $query->where('name', 'like', "%{$search}%")
              ->orWhereHas('category', fn ($q) =>
                  $q->where('name', 'like', "%{$search}%")
              );
    }

    return $query->get();
}
}
