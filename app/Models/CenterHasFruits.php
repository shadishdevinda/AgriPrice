<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterHasFruits extends Model
{
    protected $table = 'center_has_fruit';
    protected $fillable = [
        'center_id',
        'fruit_id',
        'fruit_wholesale_price',
        'fruit_retail_price',
        'created_at',
        'updated_at'
    ];
}
