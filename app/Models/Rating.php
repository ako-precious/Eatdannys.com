<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $fillable = ['user_id', 'meal_id', 'rating'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
    public function scopeForMeal($query, $mealId)
    {
        return $query->where('meal_id', $mealId);
    }
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    public function scopeAverageRating($query)
    {
        return $query->avg('rating');
    }

}
