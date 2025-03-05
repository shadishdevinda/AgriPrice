<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterHasVegetables extends Model
{
    use HasFactory;

    protected $table = 'center_has_vegetable';

    protected $fillable = [
        'center_id',
        'vegetable_id',
        'vegetable_wholesale_price',
        'vegetable_retail_price',
        'created_at',
        'updated_at'
    ];

    public function center() {
        return $this->belongsTo(EconomicCenter::class, 'center_id', 'id');
    }

    public function vegetable() {
        return $this->belongsTo(Vegetable::class);
    }
}
