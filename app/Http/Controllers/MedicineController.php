<?php

namespace App\Http\Controllers;

use App\Http\Service\MedicineService;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    //
    protected $medicineService;
    public function __construct(MedicineService $medicineService)
    {
        $this->medicineService = $medicineService;
    }
    public function getMedicine($idMedicine){
        return $this->medicineService->getMedicine($idMedicine);
    }
    public function getListMedicine(){
        return$this->medicineService->getListMedicine();
    }
}
