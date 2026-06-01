<?php

namespace App\Http\Controllers;

use App\Models\MealPhoto;
use Illuminate\Support\Facades\Storage;

class MealPhotoController extends Controller
{
    public function show(string $id)
    {
        $photos = MealPhoto::where('meal_id', $id)->orderBy('id', 'asc')->get();

        return response()->json([
            'firstPhoto' => $photos->first(),
            'otherPhotos' => $photos,
        ]);
    }

    public function destroy(MealPhoto $photo)
    {
        Storage::disk('public')->delete($photo->image_path);
        $photo->delete();

        return response()->json(['message' => 'Photo deleted']);
    }
}
