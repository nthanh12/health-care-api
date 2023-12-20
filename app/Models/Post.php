<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'idPost';
    protected $table = 'post';
    protected $fillable = [
        'idPost',
        'idUser',
        'title',
        'img',
        'content',
        'like',
        'rating'
    ];

}
