<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vegetable extends Model
{
    use HasFactory;

    protected $table = 'vegetable'; 

    protected $fillable = [
        'name',
        'description',
        'Wholesale_Price',
        'Retail_Price',
        'image',
    ];
}