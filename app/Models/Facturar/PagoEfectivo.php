<?php

namespace App\Models\Facturar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoEfectivo extends Model
{
    use HasFactory;
    protected $table="pago_efectivo";
    protected $fillable=[
        'pago_id',
        'total'
    ];
    public $timestamps=true;
}
