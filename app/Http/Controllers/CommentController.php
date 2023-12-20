<?php

namespace App\Http\Controllers;

use App\Http\Service\CommentService;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    protected $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function getNumAllCommentMedicine($idMedicine){
        return $this->commentService->getNumAllCommentMedicine($idMedicine);
    }
    public function getTop3CommentMedicine($idMedicine){
        return $this->commentService->getTop3CommentMedicine($idMedicine);
    }
    public function getIsCommentMedicine($idMedicine, $idUser){
        return $this->commentService->isCommentMedicine($idMedicine, $idUser);
    }
    public function createCommentMedicine(Request $request){
        $result = $this->commentService->createCommentMedicine($request);
        return $result;
    }
    public function getListCommentNotification($idUser){
        return $this->commentService->getListCommentNotification($idUser);
    }
}
