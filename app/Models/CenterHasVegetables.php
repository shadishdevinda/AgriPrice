<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterHasVegetables extends Model
{
    // Use HasFactory trait to enable factory functionality for this model
    use HasFactory;

    // Define the table associated with this model
    protected $table = 'center_has_vegetable';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'center_id',            // ID of the economic center
        'vegetable_id',         // ID of the vegetable
        'vegetable_wholesale_price', // Wholesale price of the vegetable
        'vegetable_retail_price',    // Retail price of the vegetable
        'created_at',           // Timestamp for when the record was created
        'updated_at',           // Timestamp for when the record was last updated
    ];

    /**
     * Define the relationship between this model and the EconomicCenter model.
     * Each record in the 'center_has_vegetable' table belongs to a specific EconomicCenter.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function center() {
        // Belongs to relationship: Each 'CenterHasVegetables' record is related to one 'EconomicCenter'
        return $this->belongsTo(EconomicCenter::class, 'center_id', 'id');
    }

    /**
     * Define the relationship between this model and the Vegetable model.
     * Each record in the 'center_has_vegetable' table belongs to a specific Vegetable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vegetable() {
        // Belongs to relationship: Each 'CenterHasVegetables' record is related to one 'Vegetable'
        return $this->belongsTo(Vegetable::class);
    }
}
