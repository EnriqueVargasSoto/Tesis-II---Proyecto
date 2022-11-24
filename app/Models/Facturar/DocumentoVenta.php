<?php

namespace App\Models\Facturar;

use App\Models\Administracion\Cliente;
use App\Models\Mantenimiento\NumeracionConteo;
use App\Models\Mantenimiento\TipoDocumento;
use App\Models\Ventas\Pedido;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoVenta extends Model
{
    use HasFactory;
    protected $table="documento_venta";
    protected $fillable=[
        'cliente_id',
        'pedido_id',
        'correlativo_id',
        'tipo_documento_id',
        'total',
        'url_qr',
        'nombre_comprobante_archivo',
        'url_comprobante_archivo',
        'hash',
        'cdr_response',
        'regularize_response',
        'regularize',
        'estado_documento',
        'estado',
    ];
    public $timestamps=true;
    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
    public function pedido()
    {
        return $this->belongsTo(Pedido::class,'pedido_id');
    }
    public function correlativo(){
        return $this->belongsTo(NumeracionConteo::class,"correlativo_id");
    }
    public function tipoDocumento(){
        return $this->belongsTo(TipoDocumento::class,'tipo_documento_id');
    }
    public function enviosSunat()
    {
        return $this->hasMany(EnvioSunat::class,'documento_venta_id');
    }
    public function envioExitosoSunat()
    {
        return $this->hasOne(EnvioSunat::class,'documento_venta_id')->where('envio_sunat.estado','ACEPTADO');
    }
}
