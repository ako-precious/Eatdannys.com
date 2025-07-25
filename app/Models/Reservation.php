<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
     use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'time',
        'guests',
        'special_requests'
    ];

    // app/Models/Reservation.php
protected $casts = [
    'date' => 'date:Y-m-d',
    'time' => 'datetime:H:i',
];


}
