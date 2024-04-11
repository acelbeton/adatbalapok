<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    protected $table = 'Legitarsasagok'; // Az adatbázis tábla neve
    public $timestamps = false; // nincs created_at és updated_at mező

    protected $fillable = [
        'name',
        'website',
        'rating',
        'headquarters',
    ];
}
