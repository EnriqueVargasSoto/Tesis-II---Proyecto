<?php

namespace App\Models\Administracion;

use App\Models\UserAppCliente;
use App\Models\Ventas\Pedido;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table="clientes";
    protected $fillable=[
        'nombre',
        'tipo_documento',
        'documento',
        'telefono',
        'direccion',
        'email',
        'estado'
    ];
    public $timestamps=true;
    public function pedidos()
    {
        return $this->hasMany(Pedido::class,'cliente_id');
    }
    public function user_app(){
        return $this->hasOne(UserAppCliente::class,'cliente_id');
    }
}
