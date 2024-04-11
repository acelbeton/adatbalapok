<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'FELHASZNALOK'; // Specify your table name here
    public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $fillable = [
        'EMAIL', 'PASSWORD', 'NAME'
    ];

    protected function casts(): array
    {
        return [
            'PRIVILEGE' => 'user',
        ];
    }
}
