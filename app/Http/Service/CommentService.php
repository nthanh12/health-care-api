<?php

namespace App\Http\Service;

use App\Models\Comment;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Rating;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class CommentService
{
    public function getTop3CommentPost($idPost){

    }
    public function getNumAllCommentMedicine($idMedicine){
        $numComment = Comment::where('idMedicine', $idMedicine)->count();
        return $numComment;
    }
    public function getTop3CommentMedicine($idMedicine){
        $comments = Comment::join('user', 'user.idUser', '=', 'comment.idUser')
            ->where('comment.idMedicine', $idMedicine)
            ->orderby('created_at', 'desc')
            ->limit(3)
            ->get();

        $result = [];

        foreach ($comments as $comment) {
            $commentData = [
                'idComment' => $comment->idComment,
                'idUser' => $comment->idUser,
                'user' => [
                    'idUser' => $comment->idUser,
                    'nameUser' => $comment->nameUser,
                    'birthday' => $comment->birthday,
                    'email' => $comment->email,
                    'avatar' => $comment->avatar,
                ],
                'idMedicine' => $comment->idMedicine,
                'content' => $comment->content,
                'isCheck' => $comment->isCheck == 1 ? true : false,
                'created_at' => $comment->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $comment->updated_at,
            ];

            $result[] = $commentData;
        }

        return response()->json($result);
    }
    public function isCommentMedicine($idMedicine, $idUser){
        $comment = Comment::where('idMedicine', $idMedicine)
                            ->where('idUser', $idUser)
                            ->first();
        if ($comment) return 1;
        else return 0;
    }
    public function createCommentMedicine($request){
        try {

            DB::beginTransaction();
            Comment::create([
                'idUser' => (int) $request->input('idUser'),
                'idMedicine' => (int) $request->input('idMedicine'),
                'content' => $request->input('content')
            ]);

            DB::commit();
            return response()->json(['status' => 'success']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }
    public function getListCommentNotification($idUser){
        $result = [];
        $commentPost = Comment::join('user', 'user.idUser', '=', 'comment.idUser')
            ->join('post', 'post.idUser', '=', 'user.idUser')
            ->where('comment.idUser', '!=', $idUser) // loại bỏ comment của người dùng hiện tại
            ->where('post.idUser', $idUser) // chỉ lấy comment của bài viết có idUser bằng với idUser của User
            ->select('comment.*', 'post.idPost', 'user.*')
            ->orderby('comment.created_at', 'desc')
            ->get();
        if (Doctor::where('idUser', $idUser)->exists()) {
            $doctor = Doctor::where('idUser', $idUser)->first();
            $medicines = Medicine::where('idDoctor', $doctor->idDoctor)->get();

            $medicineIds = $medicines->pluck('idMedicine');

            $commentMedicine = Comment::whereIn('comment.idMedicine', $medicineIds)
                ->where('comment.idUser', '!=', $idUser)
                ->join('user', 'user.idUser', '=', 'comment.idUser')
                ->join('medicine', 'medicine.idMedicine', '=', 'comment.idMedicine') // thêm bảng medicine vào câu lệnh join
                ->select('comment.*', 'medicine.idMedicine', 'user.*')
                ->orderby('comment.created_at', 'desc')
                ->get();
            foreach ($commentMedicine as $comment) {
                $commentData = [
                    'idComment' => $comment->idComment,
                    'idUser' => $comment->idUser,
                    'user' => [
                        'idUser' => $comment->idUser,
                        'nameUser' => $comment->nameUser,
                        'birthday' => $comment->birthday,
                        'email' => $comment->email,
                        'avatar' => $comment->avatar,
                    ],
                    'idMedicine' => $comment->idMedicine,
                    'content' => $comment->content,
                    'isCheck' => $comment->isCheck == 1 ? true : false,
                    'created_at' => $comment->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $comment->updated_at,
                ];

                $result[] = $commentData;
            }
        }

        foreach ($commentPost as $comment) {
            $commentData = [
                'idComment' => $comment->idComment,
                'idUser' => $comment->idUser,
                'user' => [
                    'idUser' => $comment->idUser,
                    'nameUser' => $comment->nameUser,
                    'birthday' => $comment->birthday,
                    'email' => $comment->email,
                    'avatar' => $comment->avatar,
                ],
                'idPost' => $comment->idPost,
                'content' => $comment->content,
                'isCheck' => $comment->isCheck == 1 ? true : false,
                'created_at' => $comment->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $comment->updated_at,
            ];

            $result[] = $commentData;
        }
        usort($result, function ($item1, $item2) {
            return strtotime($item2['created_at']) <=> strtotime($item1['created_at']);
        });
        return response()->json($result);
    }
}
