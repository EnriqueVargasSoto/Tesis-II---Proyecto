<?php

namespace App\Models;

use App\Models\Abastecimiento\DetallePlato;
use App\Models\Ventass\Pedido;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    use HasFactory;
    protected $table="plato";
    protected $fillable=[
        'tipoplato_id',
        'producto_id',
        'estado'
    ];
    public $timestamps=true;
    public function tipoPlato(){
        return $this->belongsTo(TipoPlato::class,'tipoplato_id');
    }
    public function detallePlato(){
        return $this->hasMany(DetallePlato::class,'plato_id');
    }
    public function pedidos(){
        return $this->hasMany(Pedido::class,'plato_id');
    }
    public function producto(){
        return $this->belongsTo(Producto::class,'producto_id');
    }
}
