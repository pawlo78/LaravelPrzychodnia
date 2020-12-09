<?php

namespace App\Repositories;

use App\Models\Visit;

//klasa posredniczaca miedzy modelem a kontrollerem
//logika dostępu do BD - dziedziczy po Bazowym Repozytorium
class VisitRepository extends BaseRepository
{
    public function __construct(Visit $model)
    {
        $this->model = $model;
    }
}
