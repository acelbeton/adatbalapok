<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsurantPackage extends Model
{
    protected $table = 'BiztositasiCsomagok'; // Az adatbázis tábla neve
    public $timestamps = false; // Ha nincs created_at és updated_at meződ

    protected $fillable = [
        'name',
        'insurance_company_name',
        'price',
    ];
}
