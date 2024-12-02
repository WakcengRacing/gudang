<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tambahkan role di sini
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Metode untuk memeriksa peran
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    public function isUser()
    {
        return $this->role === 'user';
    }
}    


