<?php

namespace App\Http\Service;

use App\Models\Medicine;
use App\Models\Rating;
use Exception;
use Illuminate\Support\Facades\DB;

class RatingService
{
    public function getTop3RatingCommentMedicine($idMedicine){
        $rating = Rating::where('idMedicine', $idMedicine)
                        ->orderby('idRating', 'desc')
                        ->limit(3)
                        ->get();
        return response()->json($rating);
    }
    public function addRatingMedicine($request){
        try {
            DB::beginTransaction();
            Rating::create([
                'idUser' => (int) $request->input('idUser'),
                'idMedicine' => (int) $request->input('idMedicine'),
                'rating' => $request->input('rating')
            ]);
            // Tính trung bình cộng của cột rating trong bảng Rating
            $averageRating = Rating::where('idMedicine', $request->input('idMedicine'))->avg('rating');
            // Làm tròn averageRating đến 1 chữ số thập phân
            $averageRating = round($averageRating, 1);
            // Cập nhật cột rating của bảng Medicine
            Medicine::where('idMedicine', $request->input('idMedicine'))->update(['rating' => $averageRating]);
            DB::commit();
            return response()->json(['status' => 'success']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }
}
