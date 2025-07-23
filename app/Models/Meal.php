<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meal extends Model
{

    use HasFactory;
    protected $table = 'meals';
    protected $fillable = ['category_id', 'name', 'description', 'prices'];

    protected $casts = [
        'prices' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(MealPhoto::class);
    }
}
