<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VegetableHasAdvice extends Model
{
    use HasFactory; // Use Laravel's HasFactory trait for generating factory data

    /**
     * The table associated with the model.
     *
     * This model represents the relationship between vegetables and their associated advice.
     * Each record in this table links a specific vegetable with a piece of advice.
     *
     * @var string
     */
    protected $table = 'vegetable_has_advice'; // The name of the pivot table associating vegetables with advice

    /**
     * The attributes that are mass assignable.
     *
     * These are the fields that can be mass-assigned when creating or updating a record.
     * This model holds references to both the `advice_id` and `vegetable_id` foreign keys.
     *
     * @var array
     */
    protected $fillable = [
        'advice_id', // The ID of the associated advice
        'vegetable_id', // The ID of the associated vegetable
    ];

    /**
     * Get the vegetable advice associated with this record.
     *
     * This method defines the inverse relationship for the advice linked to a vegetable.
     * Each record in the `vegetable_has_advice` table represents a link to a specific piece of advice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advice()
    {
        // Defines the inverse of the many-to-many relationship, linking this record to a specific piece of advice
        return $this->belongsTo(VegetableAdvice::class, 'advice_id'); // 'advice_id' is the foreign key linking to the `vegetable_advice` table
    }

    /**
     * Get the vegetable associated with this record.
     *
     * This method defines the inverse relationship for the vegetable linked to the advice.
     * Each record in the `vegetable_has_advice` table represents a link to a specific vegetable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vegetable()
    {
        // Defines the inverse of the many-to-many relationship, linking this record to a specific vegetable
        return $this->belongsTo(Vegetable::class, 'vegetable_id'); // 'vegetable_id' is the foreign key linking to the `vegetable` table
    }

}
