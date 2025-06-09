<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPhoto extends Model
{
    //

    public function meal()
{
    return $this->belongsTo(Meal::class);
}
}
