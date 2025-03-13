<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterHasFruits extends Model
{
    // Define the table associated with the model
    protected $table = 'center_has_fruit';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'center_id',           // ID of the economic center
        'fruit_id',            // ID of the fruit
        'fruit_wholesale_price', // Wholesale price of the fruit
        'fruit_retail_price',  // Retail price of the fruit
        'created_at',          // Timestamp for when the record was created
        'updated_at',          // Timestamp for when the record was last updated
    ];

    /**
     * Define the relationship between this model and the EconomicCenter model.
     * Each record in the 'center_has_fruit' table belongs to a specific EconomicCenter.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function center() {
        // Belongs to relationship: Each 'CenterHasFruits' record is related to one 'EconomicCenter'
        return $this->belongsTo(EconomicCenter::class, 'center_id', 'id');
    }

    /**
     * Define the relationship between this model and the Fruit model.
     * Each record in the 'center_has_fruit' table belongs to a specific Fruit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fruit() {
        // Belongs to relationship: Each 'CenterHasFruits' record is related to one 'Fruit'
        return $this->belongsTo(Fruit::class);
    }
}
