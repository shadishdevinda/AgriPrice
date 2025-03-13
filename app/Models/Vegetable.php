<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vegetable extends Model
{
    use HasFactory; // Use Laravel's HasFactory trait for generating factory data

    /**
     * The table associated with the model.
     *
     * The model represents vegetables in the system, with each vegetable having its own set of attributes
     * like name, description, and image.
     *
     * @var string
     */
    protected $table = 'vegetable'; // The name of the table associated with this model is 'vegetable'

    /**
     * The attributes that are mass assignable.
     *
     * These attributes define the fields that can be mass-assigned when creating or updating a record.
     * These are the attributes that can be passed as input data when adding or updating vegetable records.
     *
     * @var array
     */
    protected $fillable = [
        'name',        // The name of the vegetable
        'description', // A brief description of the vegetable
        'image',       // The image of the vegetable (path to the image file)
    ];

    /**
     * Get the vegetable advice associated with this vegetable.
     *
     * This method defines the many-to-many relationship between vegetables and vegetable advice.
     * A vegetable can have multiple pieces of advice, and each piece of advice can apply to multiple vegetables.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function advice()
    {
        // Defines a many-to-many relationship with the `VegetableAdvice` model through the pivot table `vegetable_has_advice`.
        return $this->belongsToMany(VegetableAdvice::class, 'vegetable_has_advice', 'vegetable_id', 'advice_id');
        // 'vegetable_id' and 'advice_id' are the foreign keys used to link the tables
    }

}
