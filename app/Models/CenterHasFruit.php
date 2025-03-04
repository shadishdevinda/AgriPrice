<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterHasFruit extends Model {
    use HasFactory;

    protected $table = 'center_has_fruit'; // Table name for fruits

    protected $fillable = [
        'center_id',
        'fruit_id',
        'fruit_wholesale_price',
        'fruit_retail_price',
        'created_at',
        'updated_at'
    ];

    public function center() {
        return $this->belongsTo(EconomicCenter::class, 'center_id', 'id');
    }

    public function fruit() {
        return $this->belongsTo(Fruit::class);
    }
}
