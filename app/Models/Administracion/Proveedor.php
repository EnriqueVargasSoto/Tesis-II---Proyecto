<?php

namespace App\Models\Administracion;

use App\Models\Compras\DocCompra;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table="proveedor";
    protected $fillable=[
        'nombre_comercial',
        'numero_documento',
        'telefono','direccion','estado'
    ];
    public $timestamps=true;
    public function DocCompra()
    {
        return $this->hasMany(DocCompra::class,'proveedor_id');
    }
}
