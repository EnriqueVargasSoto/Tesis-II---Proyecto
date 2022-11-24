<?php

namespace App\Models\Compras;

use App\Models\Abastecimiento\Insumo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleDocCompra extends Model
{
    use HasFactory;
    protected $table="detalle_compra";
    protected $fillable = [
        'doc_compra_id',
        'insumo_id',
        'cantidad',
        'precio'
    ];
    public $timestamp=true;

    public function DocCompra()
    {
        return $this->belongsTo(DocCompra::class,'doc_compra_id');
    }
    public function Insumo()
    {
        return $this->belongsTo(Insumo::class,'insumo_id');
    }
}
