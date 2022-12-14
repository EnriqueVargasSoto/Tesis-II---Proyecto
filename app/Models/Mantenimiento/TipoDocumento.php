<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;
    protected $table="tipo_documento";
    protected $fillable=[
        'tipo','descripcion'
    ];
    public $timestamps=true;
    public function numeraciones()
    {
        return $this->hasMany(Numeracion::class,'tipo_documento_id');
    }
    public function numeracionSeleccionada()
    {
        return $this->hasOne(Numeracion::class,'tipo_documento_id')->where('seleccionado','SI');
    }
}
