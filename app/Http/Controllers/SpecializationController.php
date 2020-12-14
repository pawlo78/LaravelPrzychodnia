<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SpecializationRepository;
use App\Models\Specialization;
use Illuminate\Support\Facades\Auth;

class SpecializationController extends Controller
{
    //protected UserRepository $userRipo;
    protected $specializationRipo;

    public function __construct(SpecializationRepository $specializationRipo)
    {
        $this->specializationRipo = $specializationRipo;
        $this->middleware('auth');
    }

    public function index()
    {
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    

        $specializations = $this->specializationRipo->getAll();

        return view('specializations.list', [
            "specializations" => $specializations,
            "title" => 'Moduł specjalizacji',
            "footerDate" => Date('Y')
        ]);
    }

    public function create() 
    {
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    
        return view('specializations.create', ["footerDate" => Date('Y')]);
    }

    public function store(Request $request) 
    {
        //autoryzacja logowania
        if(Auth::user()->type != 'doctor' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }    
        //stworzenie nowego obiektu
        $specialization = new Specialization;
        //przypis wartosci input do pola name tego obiektu
        $specialization->name = $request->input('name');
        //zapisanie danych w BD
        $specialization->save();
        //przekierownie na liste specjalizacji
        return redirect()->action('App\Http\Controllers\SpecializationController@index');

    }
}
