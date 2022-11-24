<?php

namespace App\Models;

use App\Models\Ventass\PedidoMesa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    protected $table='mesas';
    protected $fillable = [
        'numero',
        'url_imagen',
        'nombre_imagen',
        'descripcion',
        'disponibilidad',
        'tipomesa_id',
        'ambiente_id',
        'estado'
    ];
    public $timestamp=true;
    public function tipoMesa(){
        return $this->belongsTo(TipoMesa::class,'tipomesa_id');
    }
    public function pedidoMesa(){
        return $this->hasMany(PedidoMesa::class,'mesa_id');
    }
}
