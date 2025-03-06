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

    // vegetables for each advice
    public function vegetables()
    {
        return $this->belongsToMany(Vegetable::class, 'vegetable_has_advice', 'advice_id', 'vegetable_id');
    }
}
