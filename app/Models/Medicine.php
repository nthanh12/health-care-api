<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $primaryKey = 'idMedicine';
    protected $table = 'medicine';
    protected $fillable = [
        'idMedicine',
        'idDoctor',
        'nameMedicine',
        'img',
        'price',
        'content',
        'like',
        'rating'
    ];
}
