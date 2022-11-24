<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMesa extends Model
{
    protected $table = "tipo_mesa";
    protected $fillable = ['tipo', 'npersonas', 'estado'];
    public $timestamps = true;
    public function mesas()
    {
        return $this->hasMany(Mesa::class,'tipomesa_id');
    }
}
