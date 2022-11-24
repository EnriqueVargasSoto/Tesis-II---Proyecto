<?php

namespace App\Models;

use App\Models\Abastecimiento\TipoBebida;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bebida extends Model
{
    use HasFactory;
    protected $table="bebida";
    protected $fillable=[
        'producto_id',
        'estado',
        'tipobebida_id'
    ];
    public $timestamps=true;
    public function producto(){
        return $this->belongsTo(Producto::class,'producto_id');
    }
    public function tipoBebida(){
        return $this->belongsTo(TipoBebida::class,'tipobebida_id');
    }

}
