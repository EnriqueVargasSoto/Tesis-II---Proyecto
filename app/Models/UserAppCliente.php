<?php

namespace App\Models;

use App\Models\Administracion\Cliente;
use App\Models\Administracion\Persona;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAppCliente extends Model
{
    use HasFactory;
    protected $table="user_appcliente";
    protected $fillable=[
        'cliente_id',
        'user_id'
    ];
    public $timestamps=true;
    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
    public function user() {
        return $this->belongsTo(UserApp::class,'user_id');
    }
}
