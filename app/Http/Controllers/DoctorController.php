<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Specialization;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{

    //protected UserRepository $userRepo;
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
        //wywoływanie kontrolera dostepu middleware
        //dodanie filtru auth - bedzie sprawdzal czy user jest zalogowany
        $this->middleware('auth');
    }

    public function index()
    {
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }       
        
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
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    
        
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
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    

        $doctor = $this->userRepo->find($id);

        return view('doctors.show', [
            "doctor" => $doctor,
            "title" => 'Moduł lekarzy',
            "footerDate" => Date('Y')
        ]);
    }

    public function store(Request $request) 
    {
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    
        //walidowanie danych
        //błedy sa dodawane do sesji i mozna wykorzystac je w formualrzu
        //$erros->any(), $errors->all()
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email', //sprawdzenie w tabeli i kolumnie
            'password' => 'required|min:5',
            'phone' => 'required',
            'address' => 'required',
            'pesel' => 'required'
        ]);
        
        
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
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    

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
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    

        $doctor = $this->userRepo->find($id);
        $specializations = Specialization::all();
        return view('doctors.edit', ["specializations"=>$specializations, "doctor"=>$doctor, "footerDate" => Date('Y')]);
        
    }

    public function editStore(Request $request) 
    {
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    

        //stworzenie nowego obiektu
        $doctor = User::find($request->input('doctorId'));
        $doctor->name = $request->input('name');
        $doctor->email = $request->input('email');        
        $doctor->phone = $request->input('phone');
        $doctor->address = $request->input('address');
        $doctor->pesel = $request->input('pesel');
        $doctor->status = $request->input('status');        
        $doctor->save();
        $doctor->specializations()->sync($request->input('specializations'));

        return redirect()->action('App\Http\Controllers\DoctorController@index');

    }
    
    public function delete($id)
    {
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    
        
        $doctor = $this->userRepo->delete($id);
        return redirect('doctors');
    }
}
