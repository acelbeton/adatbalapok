<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurant extends Model
{
    protected $table = 'Biztositok'; // Az adatbázis tábla neve
    public $timestamps = false; // Ha nincs created_at és updated_at meződ
    protected $primaryKey = 'name'; // A tábla elsődleges kulcsa
    public $incrementing = false; // Mivel nem numerikus az elsődleges kulcs

    protected $fillable = [
        'name',
        'website',
    ];
}
