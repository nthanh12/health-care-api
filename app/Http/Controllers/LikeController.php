<?php

namespace App\Http\Controllers;

use App\Http\Service\LikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    protected $likeService;
    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }
    public function getLikeMedicine($idMedicine, $email){
        return $this->likeService->getIsLikeMedicine($idMedicine, $email);
    }
    public function addLike(Request $request){
        return $this->likeService->addLike($request);
    }
    public function deleteLike(Request $request){
        return $this->likeService->deleteLike($request);
    }
}
