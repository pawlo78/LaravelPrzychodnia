<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UserRepository;

class PatientController extends Controller
{
    //protected UserRepository $userRepo;
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $user = $this->userRepo->getAllPatients();
        return view('patients.list', [
            "listPatientsx" => $user,
            "title" => 'Moduł pacjentów',
            "footerDate" => Date('Y')            
        ]);
    }

    public function show($id)
    {        
        $patient = $this->userRepo->find($id);

        return view('patients.show', [
            "patient" => $patient,
            "title" => 'Moduł pacjentów',
            "footerDate" => Date('Y')
        ]);
    }
}
