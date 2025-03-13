<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    use HasFactory; // Use Laravel's HasFactory trait for generating factory data

    // Define the table associated with this model
    protected $table = 'fruit'; // The table name is 'fruit' in the database

    // Define the attributes that are mass assignable
    protected $fillable = [
        'name',        // Name of the fruit (e.g., "Apple", "Orange")
        'description', // A description of the fruit (e.g., color, taste, or other details)
        'image',       // Path or URL to an image of the fruit
    ];

    /**
     * Define the relationship between Fruit and FruitAdvice.
     *
     * A fruit can have many pieces of advice through a pivot table `fruit_has_advice`.
     * The method establishes a many-to-many relationship with the FruitAdvice model.
     */
    public function advice()
    {
        return $this->belongsToMany(
            FruitAdvice::class,     // The related model (FruitAdvice)
            'fruit_has_advice',     // The pivot table name
            'fruit_id',             // Foreign key on the pivot table for the fruit
            'advice_id'             // Foreign key on the pivot table for the advice
        );
    }
}
