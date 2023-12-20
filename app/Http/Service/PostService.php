<?php

namespace App\Http\Service;

use App\Models\Doctor;
use App\Models\Post;

class PostService
{
    public function getNumPost($idUser)
    {
        $numPost = Post::where('idUser', $idUser)->count();
        return $numPost;
    }

    public function getListNumPostDoctor()
    {
        $doctors = Doctor::join('user', 'user.idUser', '=', 'doctor.idUser')
            ->orderBy('user.idUser', 'desc')
            ->get();

        $postsCount = [];

        foreach ($doctors as $doctor) {
            $postCount = Post::where('idUser', $doctor->idUser)->count();
            $postsCount[] = $postCount;
        }

        return $postsCount;
    }

    public function getListPost(){
        $post = Post::all();
        return $post;
    }
}
