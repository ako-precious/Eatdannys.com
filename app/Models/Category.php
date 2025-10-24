<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = ['name', 'order_type'];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }
}
