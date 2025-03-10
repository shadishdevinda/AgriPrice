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
        'image',
    ];

    public function advice()
    {
        return $this->belongsToMany(VegetableAdvice::class, 'vegetable_has_advice', 'vegetable_id', 'advice_id');
    }

}
