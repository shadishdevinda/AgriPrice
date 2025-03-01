<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FruitAdvice extends Model
{
    use HasFactory;

    protected $table = 'fruit_advice';

    protected $fillable = [
        'description',
    ];

    // fruits for each advice
    public function fruits()
    {
        return $this->belongsToMany(Fruit::class, 'fruit_has_advice', 'advice_id', 'fruit_id');
    }
}
