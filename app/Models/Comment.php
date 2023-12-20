<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'idComment';
    protected $table = 'comment';
    protected $fillable = [
        'idComment',
        'idUser',
        'idPost',
        'idMedicine',
        'content',
        'isCheck'
    ];
}
