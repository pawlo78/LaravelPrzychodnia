<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\VisitRepository;
use App\Repositories\UserRepository;
use App\Models\Visit;
use App\Models\User;
use Mail;
use Illuminate\Support\Facades\Auth;
    

class VisitController extends Controller
{
    protected $visitRipo;

    public function __construct(VisitRepository $visitRipo)
    {
        $this->visitRipo = $visitRipo;
        $this->middleware('auth');
    }

    public function index()
    {
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    
        $visits = $this->visitRipo->getAll();

        return view('visits.list', [
            "visits" => $visits,
            "title" => 'Moduł wizyt',
            "footerDate" => Date('Y')
        ]);
    }   

    //create doctor from form
    public function create(UserRepository $userRepo)
    {       
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    

        $doctors = $userRepo->getAllDoctors();
        $patients = $userRepo->getAllPatients();

        return view('visits.create', [ "footerDate" => Date('Y'),  
                                "title" => 'Moduł wizyt', 
                                "doctors" => $doctors, 
                                "patients"=> $patients]);        
    }

    public function store(Request $request) 
    {
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    
        //stworzenie nowego obiektu
        $visit = new Visit;
        //przypis wartosci input do pola name tego obiektu
        $visit->doctor_id = $request->input('doctor');
        $visit->patient_id = $request->input('patient');
        $visit->date = $request->input('date');
        //zapisanie danych w BD
        $visit->save();

        //wysylanie maila potwierdzajcego
        $patient = USER::find($visit->patient_id);
        Mail::send('emails.visit', ['visit' => $visit], function ($m) use ($visit, $patient) {
            $m->to($patient->email, $patient->name)->subject('Nowa wizyta');
        });



        //przekierownie na liste specjalizacji
        return redirect()->action('App\Http\Controllers\VisitController@index');

    }
}
