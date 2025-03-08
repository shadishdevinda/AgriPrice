<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FruitHasAdvice extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fruit_has_advice';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'advice_id',
        'fruit_id',
    ];

    /**
     * Get the fruit advice associated with this record.
     */
    public function advice()
    {
        return $this->belongsTo(FruitAdvice::class, 'advice_id');
    }

    /**
     * Get the fruit associated with this record.
     */
    public function fruit()
    {
        return $this->belongsTo(Fruit::class, 'fruit_id');
    }

    

}
