<?php

namespace App\Http\Controllers;

use App\Http\Service\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    protected $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function getNumPost($idUser){
        return $this->postService->getNumPost($idUser);
    }
    public function getListNumPostDoctor(){
        return $this->postService->getListNumPostDoctor();
    }
    public function getListPost() {
        return $this->postService->getListPost();
    }
}
