<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $primaryKey = 'idLike';
    protected $table = 'like';
    public $timestamps = false;
    protected $fillable = [
        'idLike',
        'idUser',
        'idPost',
        'idMedicine'
    ];
}
