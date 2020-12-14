<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

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
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    

        $user = $this->userRepo->getAllPatients();
        return view('patients.list', [
            "listPatientsx" => $user,
            "title" => 'Moduł pacjentów',
            "footerDate" => Date('Y')            
        ]);
    }

    public function show($id)
    {      
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    

        $patient = $this->userRepo->find($id);

        return view('patients.show', [
            "patient" => $patient,
            "title" => 'Moduł pacjentów',
            "footerDate" => Date('Y')
        ]);
    }

    public function store(Request $request)
    {      
       
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email', //sprawdzenie w tabeli i kolumnie
            'password' => 'required|min:5',
            'phone' => 'required',
            'address' => 'required',
            'pesel' => 'required'
        ]);        
        
        //stworzenie nowego obiektu
        $patient = new User;
        $patient->name = $request->input('name');
        $patient->email = $request->input('email');
        $patient->password = bcrypt($request->input('password'));
        $patient->phone = $request->input('phone');
        $patient->address = $request->input('address');
        $patient->pesel = $request->input('pesel');
        $patient->status = $request->input('status');
        $patient->type = 'patient';
        $patient->save();

        return view('patients.confirm', ["title" => 'Rejestracja']);
    }
}
