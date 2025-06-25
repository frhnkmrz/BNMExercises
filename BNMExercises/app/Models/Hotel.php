<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'title',
        'description',
        'rating',
        'image',
        'price_per_night',
        'category',
    ];
}
