<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SpecializationRepository;
use App\Models\Specialization;

class SpecializationController extends Controller
{
    //protected UserRepository $userRipo;
    protected $specializationRipo;

    public function __construct(SpecializationRepository $specializationRipo)
    {
        $this->specializationRipo = $specializationRipo;
    }

    public function index()
    {
        $specializations = $this->specializationRipo->getAll();

        return view('specializations.list', [
            "specializations" => $specializations,
            "title" => 'Moduł specjalizacji',
            "footerDate" => Date('Y')
        ]);
    }

    public function create() 
    {
        return view('specializations.create', ["footerDate" => Date('Y')]);
    }

    public function store(Request $request) 
    {
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
