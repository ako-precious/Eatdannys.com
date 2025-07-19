<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealPhoto;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class MealController extends Controller
{
    public function getMeals(Request $request)
    {

        $perPage = $request->get('per_page', 9);
        $search = $request->input('search');

        $query = Meal::with('category','photos')->orderBy("id", "desc") ;
        



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
            'meals' => $query->whereHas('category', function ($query) {
        $query->where('order_type', 'bulk');
    })->paginate($perPage),
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
    public function edit(Meal $meal)
    {
        // $meal = Meal::with( 'category')->find(1);
        $meal::with( 'category', 'photo');
        $categories = Category::all();
        $photos =  MealPhoto::where('meal_id',  $meal->id)->get();
        // dd($meal, $meal->id, MealPhoto::where('meal_id',  $meal->id)->get());
        return inertia('Meals/Edit', [
            'Meal' => $meal,
            'Categories' => $categories,
            'Photos'=> $photos
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meal $meal)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'nullable|exists:categories,id',
        'description' => 'nullable|string',
        'prices' => 'required|json',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
    ]);
    Log::info('Decoded Prices:', json_decode($request->prices, true));


    $meal->update([
        'name' => $request->name,
        'category_id' => $request->category_id,
        'description' => $request->description,
        'prices' => json_decode($request->prices, true),
    ]);

    // Save images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('meal_images', 'public');
            $meal->photos()->create(['image_path' => $path]);
        }
    }
    
  return response()->json([
            'request' => $request,
            'meal' => $meal,
             'raw_input' => file_get_contents('php://input'),
    'form_data' => $request->all(),
    'files' => $request->file(),
        ]);

    // return back()->with('success', 'Meal updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
