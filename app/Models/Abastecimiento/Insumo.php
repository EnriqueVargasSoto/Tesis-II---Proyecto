<?php

namespace App\Models\Abastecimiento;

use App\Models\Compras\DetalleDocCompra;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;
    protected $table="insumo";
    protected $fillable=[
        'nombre','stock','unidad_id','precio'
    ];
    public function unidad()
    {
        return $this->belongsTo(Unidad::class,'unidad_id');
    }
    public function detalleCompra(){
        return $this->hasMany(DetalleDocCompra::class,'insumo_id');
    }
    public function detallePlato(){
        return $this->hasMany(DetallePlato::class,'insumo_id');
    }

}
