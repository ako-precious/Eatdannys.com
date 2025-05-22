<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $table = 'orders';
    // meal_id represents the scheduled meal id 
    protected $fillable = ['session_id','menu', 'total_price', 'status', 'user_id', 'address'];
    

    protected $casts = [
        'menu' => 'array', // This tells Eloquent to automatically cast to/from JSON
        'address' => 'array', // This tells Eloquent to automatically cast to/from JSON
    ];

    public function User()
    {

        return $this->belongsTo(User::class);
    }
}
