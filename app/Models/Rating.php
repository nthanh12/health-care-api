<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $primaryKey = 'idRating';
    protected $table = 'rating';
    public $timestamps = false;
    protected $fillable = [
        'idLike',
        'idUser',
        'idDoctor',
        'idPost',
        'idMedicine',
        'rating'
    ];
}
