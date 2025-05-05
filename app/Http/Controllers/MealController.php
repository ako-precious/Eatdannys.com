<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index()
    {
        // eager load category if needed
        return Meal::with('category')->get();
    }
}
