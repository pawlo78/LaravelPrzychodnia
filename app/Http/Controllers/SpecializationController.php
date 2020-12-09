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
}
