<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;

//klasa posredniczaca miedzy modelem a kontrollerem
//logika dostępu do BD - dziedziczy po Bazowym Repozytorium
class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAllDoctors()
    {
        return $this->model->where('type', 'doctor')->orderBy('name', 'desc')->get();
        //return DB::table('users')->where('type', '=', 'doctor')->get();
    }

    public function getAllPatients()
    {
        return $this->model->where('type', 'patient')->orderBy('name', 'desc')->get();        
    }

    public function getDoctorsStatistics()
    {
        //tworzenie fasady
        return DB::table('users')->select(DB::raw('count(*) as user_count, status'))->where('type', 'doctor')->groupBy('status')->get();
    }

    public function getDoctorsBySpecializations($id)
    {
        //tworzenie fasady
        return $this->model->where('type', 'doctor')->whereHas(
            'specializations',
            function ($q) use ($id) {
                $q->where('specializations.id', $id);
            }
        )->orderBy('name', 'asc')->get();
    }
}
