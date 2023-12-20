<?php

namespace App\Http\Service;

use App\Models\Doctor;

class DoctorService
{
    public function getDoctor($idUser){
        $doctor = Doctor::join('user', 'user.idUser', '=', 'doctor.idUser')->where('doctor.idUser', $idUser)->first();
        return response()->json($doctor);
    }
    public function getListDoctor(){
        $doctors = Doctor::join('user', 'user.idUser', '=', 'doctor.idUser')
                        ->orderby('user.idUser', 'desc')
                        ->get();
        return $doctors;
    }
}
