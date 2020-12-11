<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Specialization;
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

    public function store(Request $request) 
    {
        //stworzenie nowego obiektu
        $doctor = new User;
        $doctor->name = $request->input('name');
        $doctor->email = $request->input('email');
        $doctor->password = bcrypt($request->input('password'));
        $doctor->phone = $request->input('phone');
        $doctor->address = $request->input('address');
        $doctor->pesel = $request->input('pesel');
        $doctor->status = $request->input('status');
        $doctor->type = 'doctor';
        $doctor->save();
        $doctor->specializations()->sync($request->input('specializations'));

        return redirect()->action('App\Http\Controllers\DoctorController@index');

    }

    //create doctor from form
    public function create()
    {        
        $specializations = Specialization::all();

        return view('doctors.create', ["specializations"=>$specializations, "footerDate" => Date('Y')]);
        
        //pojedynczy uzytkownik
        // $this->userRepo->create([
        //     'name' => 'Damian Byrdy',
        //     'email' => 'damian@byrdy.com',
        //     'password' => bcrypt('password'),
        //     'phone' => 77775285,
        //     'address' => 'Warszawa, Wesoła 33',
        //     'status' => 'Active',
        //     'pesel' => '88092374874',
        //     'type' => 'doktor'
        // ]);;
        //return redirect('doctors');
    }


    //create doctor from form
    public function edit($id)
    {
        $doctor = $this->userRepo->update(['name' => "Andrzej Strzałka"], $id);
        return redirect('doctors');
    }
    
    public function delete($id)
    {
        $doctor = $this->userRepo->delete($id);
        return redirect('doctors');
    }
}
