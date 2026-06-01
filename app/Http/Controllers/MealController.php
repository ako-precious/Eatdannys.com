<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealPhoto;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    public function getMeals(Request $request)
    {
        $perPage = $request->get('per_page', 9);
        $search = $request->input('search');

        $query = Meal::with('category', 'photos')
            ->whereHas('category', fn ($q) => $q->where('order_type', 'bulk'))
            ->orderBy('id', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('category', fn ($catQuery) => $catQuery->where('name', 'like', "%{$search}%"));
            });
        }

        return response()->json(['meals' => $query->paginate($perPage)]);
    }

    public function getDineMeals(Request $request)
    {
        $perPage = $request->get('per_page', 9);
        $search = $request->input('search');

        $query = Meal::with('category', 'photos')
            ->whereHas('category', fn ($q) => $q->where('order_type', 'dine-in'))
            ->orderByRaw('FIELD(category_id, 6, 7, 8, 9, 10, 11) ASC, id ASC');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('category', fn ($catQuery) => $catQuery->where('name', 'like', "%{$search}%"));
            });
        }

        return response()->json(['meals' => $query->paginate($perPage)]);
    }

    public function index(Request $request)
    {
        return Inertia::render('Meals/Index');
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
    }

    public function show(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $meal = Meal::with('category', 'photos')->findOrFail($id);

        return inertia('Meals/Show', ['Meal' => $meal]);
    }

    public function edit(Meal $meal)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $meal->load('category', 'photos');
        $categories = Category::all();
        $photos = MealPhoto::where('meal_id', $meal->id)->get();

        return inertia('Meals/Edit', [
            'Meal' => $meal,
            'Categories' => $categories,
            'Photos' => $photos,
        ]);
    }

    public function update(Request $request, Meal $meal)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'prices' => 'required|json',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $meal->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'prices' => json_decode($request->prices, true),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('meal_images', 'public');
                $meal->photos()->create(['image_path' => $path]);
            }
        }

        return response()->json(['meal' => $meal->load('photos')]);
    }

    public function destroy(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
    }
}
