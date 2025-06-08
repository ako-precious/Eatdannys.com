<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPhoto extends Model
{
    //


    protected $fillable = ['image_path', 'meal_id']; // ✅ Add any fields you plan to mass-assign

    public function meal()
{
    return $this->belongsTo(Meal::class);
}
}
