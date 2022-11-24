<?php

namespace App\Models\Compras;

use App\Models\Administracion\Proveedor;
use App\Models\Mantenimiento\Deposito;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocCompra extends Model
{
    use HasFactory;
    protected $table = "doc_compra";
    protected $fillable = [
        'proveedor_id',
        'deposito_id',
        'ruta_imagen',
        'nombre_imagen',
        'fecha_emision',
        'fecha_entrega',
        'modo_compra',
        'tipo_moneda',
        'igv',
        'cantidad_igv',
        'estado'
    ];
    public $timestamp = true;
    public function Proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
    public function Deposito()
    {
        return $this->belongsTo(Deposito::class, 'deposito_id');
    }
    public function Detalle()
    {
        return $this->hasMany(DetalleDocCompra::class, 'doc_compra_id');
    }
    public function sumTotal()
    {
        return $this->Detalle()
            ->selectRaw('doc_compra_id, sum(cantidad * precio) as total')
            ->groupBy('doc_compra_id');
    }
}
