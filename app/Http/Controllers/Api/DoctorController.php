<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Specialization;
use App\Repositories\UserRepository;
use Illuminate\Routing\Controller as BaseController;


class DoctorController extends BaseController
{

    //protected UserRepository $userRepo;
    protected $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;        
    }

    public function index()
    {     
        $user = $this->userRepo->getAllDoctors();
        return $users->toJson();
        //routing w api.php
    }  
    
    public function show($id)
    {
        $doctor = $this->userRepo->find($id);
        return $doctor->toJson();
}
