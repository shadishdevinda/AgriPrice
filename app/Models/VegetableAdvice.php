<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VegetableAdvice extends Model
{
    use HasFactory;

    protected $table = 'vegetable_advice'; 

    protected $fillable = [
        'description',
    ];
}
