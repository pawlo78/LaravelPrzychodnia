<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['doctor_id', 'patient_id', 'date'];

    //wyciagniecie info o lekarzu o id = doctor_id - powyzej
    //tworzenie relacji w modelu
    public function doctor()
    {
        //powiazanie poprzez belongsTo gdzie podajemy model 
        //i identyfikator klucza
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        //powiazanie poprzez belongsTo gdzie podajemy model 
        //i identyfikator klucza
        return $this->belongsTo(User::class, 'patient_id');
    }
}
