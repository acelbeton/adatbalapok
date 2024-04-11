<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaneRoute extends Model
{
    protected $table = 'Jaratok'; // Az adatbázis tábla neve
    public $timestamps = false; // Ha nincs created_at és updated_at meződ

    protected $fillable = [
        'departure',
        'arrival',
        'flight_length',
        'airline',
        'child_friendly',
    ];
}
