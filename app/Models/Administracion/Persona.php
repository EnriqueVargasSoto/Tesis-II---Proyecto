<?php

namespace App\Models\Administracion;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = "persona";
    protected $fillable = [
        'nombre',
        'apellidoPaterno',
        'apellidoMaterno',
        'direccion',
        'numero_documento',
        'telefono',
        'fecchaNacimiento',
        'edad',
        'genero',
        'estadoCivil',
        'estado',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function empleado()
    {
        return $this->hasOne(Empleado::class,'persona_id');
    }
}
