<?php

namespace App\Repositories;

use App\Models\Specialization;

//klasa posredniczaca miedzy modelem a kontrollerem
//logika dostępu do BD - dziedziczy po Bazowym Repozytorium
class SpecializationRepository extends BaseRepository
{
    public function __construct(Specialization $model)
    {
        $this->model = $model;
    }
}
