<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $primaryKey = 'idDoctor';
    protected $table = 'doctor';
    protected $fillable = [
        'idDoctor',
        'idUser',
        'description',
        'ratingDoctor'
    ];
}
