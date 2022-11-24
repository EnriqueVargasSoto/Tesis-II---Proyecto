<?php

namespace App\Models\Administracion;


use Illuminate\Database\Eloquent\Model;

class TipoEmpleado extends Model
{
    protected $table="tipo_empleado";
    protected $fillable=[
        'tipo','estado'
    ];
    public $timestamps=true;
    public function empleados(){
        return $this->hasMany(Empleado::class,'tipoempleado_id');
    }
}
