<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApp extends Model
{
    use HasFactory;
    protected $table="user_app";
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    public $timestamps = true;
    public function user_cliente()
    {
        return $this->hasOne(UserAppCliente::class,'user_id');
    }
}
