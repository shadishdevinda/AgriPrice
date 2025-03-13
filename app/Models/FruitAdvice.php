<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FruitAdvice extends Model
{
    use HasFactory; // Use Laravel's HasFactory trait for generating factory data

    // Define the table associated with this model
    protected $table = 'fruit_advice'; // The table name is 'fruit_advice' in the database

    // Define the attributes that are mass assignable
    protected $fillable = [
        'description', // Description of the advice related to fruits (e.g., care tips, recipes)
    ];

    /**
     * Define the relationship between FruitAdvice and Fruit.
     *
     * A piece of fruit advice can be associated with many fruits through a pivot table `fruit_has_advice`.
     * The method establishes a many-to-many relationship with the Fruit model.
     */
    public function fruits()
    {
        return $this->belongsToMany(
            Fruit::class,          // The related model (Fruit)
            'fruit_has_advice',    // The pivot table name
            'advice_id',           // Foreign key on the pivot table for the advice
            'fruit_id'             // Foreign key on the pivot table for the fruit
        );
    }
}
