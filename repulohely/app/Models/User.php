<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'Felhasznalok'; // Specify your table name here
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'password', 'privilege',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasRole($role)
    {
        return $this->privilege === $role;
    }




}
