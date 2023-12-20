<?php

namespace App\Http\Service;

use App\Models\Like;
use App\Models\Medicine;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class LikeService
{
    public function getIsLikeMedicine($idMedicine,$email){
        $user = User::where('email', $email)->first();
        $like = Like::where('idMedicine', $idMedicine)
                    ->where('idUser', $user->idUser)->first();
        if ($like) return 1;
        else return 0;
    }
    public function addLike($request){
        try {
            DB::beginTransaction();
            if ($request->input('idMedicine')) {
                $like = Like::where('idUser', (int)$request->input('idUser'))
                    ->where('idMedicine', (int)$request->input('idMedicine'))
                    ->first();
            } else {
                $like = Like::where('idUser', (int)$request->input('idUser'))
                    ->where('idPost', (int)$request->input('idPost'))
                    ->first();
            }
            if (!$like) {
                if ($request->input('idMedicine')) {
                    Like::create([
                        'idUser' => (int)$request->input('idUser'),
                        'idMedicine' => $request->input('idMedicine')
                    ]);
                    // Tính tổng like
                    $sumLike = Like::where('idMedicine', $request->input('idMedicine'))->count();
                    // Cập nhật cột like của bảng Medicine
                    Medicine::where('idMedicine', $request->input('idMedicine'))->update(['like' => $sumLike]);

                } else{
                    Like::create([
                        'idUser' => (int)$request->input('idUser'),
                        'idPost' => $request->input('idPost')
                    ]);
                    // Tính tổng like
                    $sumLike = Like::where('idPost', $request->input('idPost'))->count();
                    // Cập nhật cột like của bảng Medicine
                    Post::where('idPost', $request->input('idPost'))->update(['like' => $sumLike]);
                }
            }
            DB::commit();
            return response()->json(['status' => 'success']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }
    public function deleteLike($request){
        try {

            DB::beginTransaction();
            if ($request->input('idMedicine')){
                $like = Like::where('idMedicine', (int) $request->input('idMedicine') )
                    ->where('idUser', (int)$request->input('idUser'))
                    ->first();
            } else {
                $like = Like::where('idPost', (int) $request->input('idPost') )
                    ->where('idUser', (int)$request->input('idUser'))
                    ->first();
            }
            if ($like){
                $like->delete();
                if ($request->input('idMedicine')) {
                    // Tính tổng like
                    $sumLike = Like::where('idMedicine', $request->input('idMedicine'))->count();
                    // Cập nhật cột like của bảng Medicine
                    Medicine::where('idMedicine', $request->input('idMedicine'))->update(['like' => $sumLike]);
                } else {
                    $sumLike = Like::where('idPost', $request->input('idPost'))->count();
                    // Cập nhật cột like của bảng Medicine
                    Post::where('idPost', $request->input('idPost'))->update(['like' => $sumLike]);
                }
            }
            DB::commit();
            return response()->json(['status' => 'success']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }
}
