<?php

namespace App\Http\Controllers;

use App\Http\Service\DoctorService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    protected $doctorService;
    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }
    public function getDoctor($idUser){
        return $this->doctorService->getDoctor($idUser);
    }
    public function getListDoctor(){
        return $this->doctorService->getListDoctor();
    }
}
