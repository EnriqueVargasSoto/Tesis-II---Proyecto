<?php

namespace App\Models;

use App\Models\Ventas\Pedido;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPedido extends Model
{
    use HasFactory;
    protected $table="tipo_pedido";
    protected $fillable = [
        'tipo_pedido'
    ];
    public $timestamps=true;
    public function pedidos(){
        return $this->hasMany(Pedido::class,'tipo_id');
    }
}
