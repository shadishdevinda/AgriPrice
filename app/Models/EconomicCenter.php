<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EconomicCenter extends Model
{
    // Define the table associated with this model
    protected $table = 'economic_center'; // The table name is 'economic_center' in the database

    // Define the primary key of the table
    protected $primaryKey = 'id'; // Explicitly set the primary key to 'id'

    // Disable auto-increment for the primary key field
    public $incrementing = false; // Since the 'id' is not auto-incremented, we disable auto-incrementing

    // Specify the data type of the primary key field
    protected $keyType = 'string'; // The 'id' is of type 'string' (for example, UUID), not an integer

    // Define the attributes that are mass assignable
    protected $fillable = [
        'id',                   // Unique identifier for the center (e.g., UUID)
        'center_name',          // Name of the economic center
        'contact_number',       // Contact number of the center
        'center_location',      // Location of the center (address or region)
        'profile_photo_path',   // Path to the profile photo of the center
    ];
}
