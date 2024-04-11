<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    protected $table = 'Repulok'; // Az adatbázis tábla neve
    public $timestamps = false;

    protected $fillable = [
        'manufacturer',
        'commercial_cap',
        'business_cap',
        'first_class_cap',
        'maintainer',
        'plane_type',
        'plane_capacity',
        'consumption',
    ];
}
