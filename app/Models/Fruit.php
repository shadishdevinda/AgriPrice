<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Fruit extends Model
{
    use HasFactory;

    protected $table = 'fruit';

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public function advice()
    {
        return $this->belongsToMany(FruitAdvice::class, 'fruit_has_advice', 'fruit_id', 'advice_id');
    }

}
