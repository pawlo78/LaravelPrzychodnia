<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'status', 'pesel', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    //wyciagniecie wizyt dla doktora i pacjenta
    public function doctorsVisits()
    {
        return $this->hasMany(Visit::class, 'doctor_id');
    }

    public function patientsVisits()
    {
        return $this->hasMany(Visit::class, 'patient_id');
    }

    //pobranie liczby specjalizacji dla danego lekarza
    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'specialization_users');
    }
}
