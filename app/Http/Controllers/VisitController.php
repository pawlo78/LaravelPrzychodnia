<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\VisitRepository;
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
}
