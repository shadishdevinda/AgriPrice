<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EconomicCenter extends Model
{
    protected $table = 'economic_center'; // table name is `economic_center`

    protected $primaryKey = 'id'; // Explicitly set the primary key

    public $incrementing = false; // Disable auto-increment

    protected $keyType = 'string'; // `id` is not an integer

    protected $fillable = [
        'id',
        'center_name',
        'contact_number',
        'center_location',
        'profile_photo_path',
    ];

    // Relationship with CenterHasVegetable
    public function vegetables()
    {
        return $this->hasMany(CenterHasVegetable::class, 'economic_center_id', 'id');
    }
}


