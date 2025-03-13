<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VegetableAdvice extends Model
{
    use HasFactory; // Use Laravel's HasFactory trait for generating factory data

    /**
     * The table associated with the model.
     *
     * The model represents vegetable advice in the system, with each piece of advice associated with one or more vegetables.
     *
     * @var string
     */
    protected $table = 'vegetable_advice'; // The name of the table associated with this model is 'vegetable_advice'

    /**
     * The attributes that are mass assignable.
     *
     * These are the fields that can be mass-assigned when creating or updating a record.
     * The 'description' field holds information about the advice related to vegetables.
     *
     * @var array
     */
    protected $fillable = [
        'description', // A description of the advice given for vegetables
    ];

    /**
     * Get the vegetables associated with this advice.
     *
     * This method defines the many-to-many relationship between vegetable advice and vegetables.
     * Each piece of advice can be associated with multiple vegetables, and each vegetable can have multiple pieces of advice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function vegetables()
    {
        // Defines a many-to-many relationship with the `Vegetable` model through the pivot table `vegetable_has_advice`.
        return $this->belongsToMany(Vegetable::class, 'vegetable_has_advice', 'advice_id', 'vegetable_id');
        // 'advice_id' and 'vegetable_id' are the foreign keys used to link the tables
    }
}
