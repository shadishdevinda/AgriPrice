<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EconomicCenter extends Model
{
    // Define the table name
    protected $table = 'economic_center';

    // Define the fillable columns
    protected $fillable = [
        'center_name',
        'center_reg_id',
        'center_location',
        'profile_photo_path',
    ];

}
