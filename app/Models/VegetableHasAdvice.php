<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VegetableHasAdvice extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vegetable_has_advice';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'advice_id',
        'vegetable_id',
    ];

    /**
     * Get the vegetable advice associated with this record.
     */
    public function advice()
    {
        return $this->belongsTo(VegetableAdvice::class, 'advice_id');
    }

    /**
     * Get the vegetable associated with this record.
     */
    public function vegetable()
    {
        return $this->belongsTo(Vegetable::class, 'vegetable_id');
    }

}
