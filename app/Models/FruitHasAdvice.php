<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FruitHasAdvice extends Model
{
    use HasFactory; // Use Laravel's HasFactory trait for generating factory data

    /**
     * The table associated with the model.
     *
     * This model represents the relationship between fruits and their advice.
     * It uses the `fruit_has_advice` pivot table to associate fruits with different pieces of advice.
     *
     * @var string
     */
    protected $table = 'fruit_has_advice'; // The pivot table name is 'fruit_has_advice'

    /**
     * The attributes that are mass assignable.
     *
     * These attributes define the fields that can be mass-assigned when creating or updating a record.
     *
     * @var array
     */
    protected $fillable = [
        'advice_id',  // The ID of the related advice (foreign key to the 'fruit_advice' table)
        'fruit_id',   // The ID of the related fruit (foreign key to the 'fruit' table)
    ];

    /**
     * Get the fruit advice associated with this record.
     *
     * This method defines the relationship between this pivot table and the `FruitAdvice` model.
     * It returns the advice associated with the current fruit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advice()
    {
        return $this->belongsTo(FruitAdvice::class, 'advice_id'); // 'advice_id' links this pivot table to the `FruitAdvice` model
    }

    /**
     * Get the fruit associated with this record.
     *
     * This method defines the relationship between this pivot table and the `Fruit` model.
     * It returns the fruit that the current advice is related to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fruit()
    {
        return $this->belongsTo(Fruit::class, 'fruit_id'); // 'fruit_id' links this pivot table to the `Fruit` model
    }
}
