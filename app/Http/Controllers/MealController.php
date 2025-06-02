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
    
    $perPage = $request->get('per_page', 9);
    $search = $request->input('search');

    $query = Meal::with('category')->orderBy("id", "desc");

  
   

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
    
        return  Inertia::render('Meals/Index');
    }
    
      public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
         return  Inertia::render('Meals/Edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
