<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $table = 'Repterek'; // Az adatbázis tábla neve
    public $timestamps = false; // nincs created_at és updated_at mező

    protected $fillable = [
        'city',
        'country',
        'name',
    ];
}
