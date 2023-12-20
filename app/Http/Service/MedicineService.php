<?php

namespace App\Http\Service;

use App\Models\Medicine;

class MedicineService
{
    public function getMedicine($idMedicine){
        $medicine = Medicine::join('doctor', 'doctor.idDoctor', '=', 'medicine.idDoctor')
            ->join('user', 'user.idUser', '=', 'doctor.idUser')
            ->where('medicine.idMedicine', $idMedicine)
            ->first();
        $result = [
            'idMedicine' => $medicine->idMedicine,
            'doctor' => [
                'idDoctor' => $medicine->idDoctor,

                    'idUser' => $medicine->idUser,
                    'nameUser' => $medicine->nameUser,
                    'birthday' => $medicine->birthday,
                    'email' => $medicine->email,
                    'avatar' => $medicine->avatar,
                    // Thêm các trường khác của người dùng tại đây

                'description' => $medicine->description,
                'ratingDoctor' => $medicine->ratingDoctor,
                // Thêm các trường khác của bác sĩ tại đây
            ],
            'nameMedicine' => $medicine->nameMedicine,
            'img' => $medicine->img,
            'price' => $medicine->price,
            'content' => $medicine->content,
            'like' => $medicine->like,
            'rating' => $medicine->rating,
            'created_at' => $medicine->created_at,
            'updated_at' => $medicine->updated_at,
        ];

        return response()->json($result);
    }
    public function getListMedicine(){
        $medicine = Medicine::all();
        return $medicine;
    }
}
