<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UserRepository;

class DoctorController extends Controller
{

    //protected UserRepository $userRepo;
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $statistics = $this->userRepo->getDoctorsStatistics();

        $user = $this->userRepo->getAllDoctors();


        return view('doctors.list', [
            "listDoctorsx" => $user,
            "title" => 'Moduł lekarzy',
            "footerDate" => Date('Y'),
            "statistics" => $statistics
        ]);
    }

    public function listBySpecialization($id)
    {
        $statistics = $this->userRepo->getDoctorsStatistics();

        $user = $this->userRepo->getDoctorsBySpecializations($id);

        return view('doctors.list', [
            "listDoctorsx" => $user,
            "title" => 'Moduł lekarzy',
            "footerDate" => Date('Y'),
            "statistics" => $statistics
        ]);
    }

    public function show($id)
    {
        //pobranie wszystkiego
        //$user = User::all();

        //pojedynczy uzytkownik
        $doctor = $this->userRepo->find($id);

        return view('doctors.show', [
            "doctor" => $doctor,
            "title" => 'Moduł lekarzy',
            "footerDate" => Date('Y')
        ]);
    }

    //create doctor from form
    public function create()
    {
        //pojedynczy uzytkownik
        $this->userRepo->create([
            'name' => 'Damian Byrdy',
            'email' => 'damian@byrdy.com',
            'password' => bcrypt('password'),
            'phone' => 77775285,
            'address' => 'Warszawa, Wesoła 33',
            'status' => 'Active',
            'pesel' => '88092374874',
            'type' => 'doktor'
        ]);;

        return redirect('doctors');
    }


    //create doctor from form
    public function edit($id)
    {
        $doctor = $this->userRepo->update(['name' => "Andrzej Strzałka"], $id);
        return redirect('doctors');
    }
}
