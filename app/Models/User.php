<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    protected $primaryKey = 'idUser';
    protected $table = 'user';
    public $timestamps = false;

    protected $fillable = [
        'idUser',
        'nameUser',
        'email',
        'birthday',
        'avatar'
    ];

    protected $dates = ['birthday'];

    public function getBirthdayAttribute($value)
    {
        // Chuyển đổi định dạng ngày trước khi trả về
        return Carbon::parse($value)->toDateString();
    }
    protected $casts = [
        'birthday' => 'date'
    ];
}
