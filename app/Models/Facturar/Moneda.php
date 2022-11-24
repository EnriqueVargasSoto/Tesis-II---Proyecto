<?php

namespace App\Models\Facturar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    use HasFactory;
    protected $table="moneda";
    protected $fillable=[
        'moneda','abreviatura'
    ];
}
