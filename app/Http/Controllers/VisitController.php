<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\VisitRepository;
use App\Repositories\UserRepository;
use App\Models\Visit;



class VisitController extends Controller
{
    protected $visitRipo;

    public function __construct(VisitRepository $visitRipo)
    {
        $this->visitRipo = $visitRipo;
    }

    public function index()
    {
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
        $doctors = $userRepo->getAllDoctors();
        $patients = $userRepo->getAllPatients();

        return view('visits.create', [ "footerDate" => Date('Y'),  
                                "title" => 'Moduł wizyt', 
                                "doctors" => $doctors, 
                                "patients"=> $patients]);        
    }

    public function store(Request $request) 
    {
        //stworzenie nowego obiektu
        $visit = new Visit;
        //przypis wartosci input do pola name tego obiektu
        $visit->doctor_id = $request->input('doctor');
        $visit->patient_id = $request->input('patient');
        $visit->date = $request->input('date');
        //zapisanie danych w BD
        $visit->save();
        //przekierownie na liste specjalizacji
        return redirect()->action('App\Http\Controllers\VisitController@index');

    }
}
